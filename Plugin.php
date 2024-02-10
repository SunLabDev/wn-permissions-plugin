<?php namespace SunLab\Permissions;

use Backend\Facades\Backend;
use Backend\Widgets\Form;
use InvalidArgumentException;
use SunLab\Permissions\Models\Permission;
use Winter\Storm\Database\Builder;
use Winter\Storm\Database\Model;
use Winter\Storm\Support\Facades\Event;
use Winter\User\Models\User;
use Winter\User\Models\UserGroup;

class Plugin extends \System\Classes\PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['Winter.User'];

    public function pluginDetails()
    {
        return [
            'name' => 'sunlab.permissions::lang.plugin.name',
            'description' => 'sunlab.permissions::lang.plugin.description',
            'author' => 'SunLab',
            'icon' => 'icon-unlock-alt',
            'homepage'    => 'https://sunlab.dev'
        ];
    }

    public function boot()
    {
        $this->extendWinterUserSideMenu();
        $this->extendUserModel();
        $this->extendUserGroupModel();
        $this->extendPermissionController('User');
        $this->extendPermissionController('UserGroup');
    }

    public function registerPermissions()
    {
        return [
            'sunlab.permissions.access_permissions' => [
                'tab'   => 'sunlab.permissions::lang.permissions.tab',
                'label' => 'sunlab.permissions::lang.permissions.access_permissions'
            ],
            'sunlab.permissions.access_user_permissions' => [
                'tab'   => 'sunlab.permissions::lang.permissions.tab',
                'label' => 'sunlab.permissions::lang.permissions.access_user_permissions'
            ],
            'sunlab.permissions.access_group_permissions' => [
                'tab'   => 'sunlab.permissions::lang.permissions.tab',
                'label' => 'sunlab.permissions::lang.permissions.access_group_permissions'
            ],
        ];
    }

    protected function extendWinterUserSideMenu()
    {
        Event::listen('backend.menu.extendItems', static function ($manager) {
            $manager->addSideMenuItems('Winter.User', 'user', [
                'permissions' => [
                    'label' => 'sunlab.permissions::lang.controllers.users.menu_label',
                    'icon' => 'icon-unlock-alt',
                    'permissions' => ['sunlab.permissions.access_permissions'],
                    'url' => Backend::url('sunlab/permissions/permissions'),
                ]
            ]);
        });
    }

    protected function extendUserModel()
    {
        User::extend(function ($model) {
            $model->belongsToMany['permissions'] = [
                \SunLab\Permissions\Models\Permission::class,
                'table' => 'sunlab_permissions_permissions_users',
            ];

            $model->addDynamicMethod(
                'hasUserPermission',
                function ($neededPermissions, string $oneOrAll = 'all') use ($model) {
                    if (!in_array($oneOrAll, ['one', 'all'])) {
                        throw new InvalidArgumentException(
                            "Second argument of hasUserPermission method should be 'one' or 'all'"
                        );
                    }

                    if (!$model->is_activated) {
                        return false;
                    }

                    $verifyPermission = static function ($grantedPermissions, $neededPermissions, $oneOrAll) {
                        return
                            ($oneOrAll === 'one' && $grantedPermissions->isNotEmpty())
                            ||
                            ($oneOrAll === 'all' && count($grantedPermissions) === count($neededPermissions));
                    };

                    $neededPermissions = (array)$neededPermissions;

                    $grantedPermissions = $model->permissions()->whereIn('code', $neededPermissions)->get();

                    // If the user got all the needed permission at his user-level, return true
                    if ($verifyPermission($grantedPermissions, $neededPermissions, $oneOrAll)) {
                        return true;
                    }

                    // If not, merge all the user's groups' permissions and re-verify again
                    $userGroupsId = $model->groups()->get()->pluck('id');

                    $grantedPermissions = $grantedPermissions->merge(
                        Permission::query()
                                  ->whereHas(
                                      'groups',
                                      static function (Builder $query) use ($userGroupsId) {
                                        return $query->whereIn('user_group_id', $userGroupsId);
                                      }
                                  )
                                  ->get()
                    )->unique('code');

                    return $verifyPermission($grantedPermissions, $neededPermissions, $oneOrAll);
                }
            );
        });
    }

    protected function extendUserGroupModel()
    {
        UserGroup::extend(function ($model) {
            $model->belongsToMany['permissions'] = [
                \SunLab\Permissions\Models\Permission::class,
                'table' => 'sunlab_permissions_groups_permissions'
            ];
        });
    }

    protected function extendPermissionController(string $modelClassName)
    {
        $controllerClass = sprintf('\Winter\User\Controllers\%ss', $modelClassName);

        /* @var Model $modelClass */
        $modelClass = sprintf('\Winter\User\Models\%s', $modelClassName);

        $modelClass::extend(static function ($model) use ($modelClassName) {
            $model->bindEvent('model.afterSave', static function () use ($modelClassName, $model) {
                if (!app()->runningInBackend()) {
                    return;
                }

                $modelPermissions = post($modelClassName . '.permissions');
                if (!$modelPermissions) {
                    return;
                }

                $permissionsChecked =
                    Permission::query()
                        ->select('id')
                        ->whereIn('code', array_keys($modelPermissions))
                        ->pluck('id');

                $model->permissions()->sync($permissionsChecked);
            });
        });

        Event::listen('backend.form.extendFields', static function (Form $widget) use ($controllerClass, $modelClass) {
            if (!$widget->getController() instanceof $controllerClass
                ||
                !$widget->model instanceof $modelClass) {
                return;
            }

            $permissionName = sprintf(
                'sunlab.permissions.access_%s_permissions',
                strtolower(class_basename($modelClass))
            );

            $widget->addTabFields([
                'permissions' => [
                    'tab'   => 'sunlab.permissions::lang.controllers.users.tab',
                    'type'    => \SunLab\Permissions\FormWidgets\PermissionEditor::class,
                    'mode' => 'checkbox',
                    'permissions' => $permissionName,
                    'availablePermissions' => Permission::query()->get()
                ]
            ]);
        });
    }
}
