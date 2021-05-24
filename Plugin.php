<?php namespace SunLab\Permissions;

use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
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
//        $this->extendUserController();
//        $this->extendUserGroupController();
    }

    public function registerPermissions()
    {
        return [
            'sunlab.permissions.access_permissions' => [
                'tab'   => 'sunlab.permissions::lang.plugin.tab',
                'label' => 'sunlab.permissions::lang.plugin.access_permissions'
            ],
            'sunlab.permissions.access_user_permissions' => [
                'tab'   => 'sunlab.permissions::lang.plugin.tab',
                'label' => 'sunlab.permissions::lang.plugin.access_user_permissions'
            ],
            'sunlab.permissions.access_group_permissions' => [
                'tab'   => 'sunlab.permissions::lang.plugin.tab',
                'label' => 'sunlab.permissions::lang.plugin.access_group_permissions'
            ],
        ];
    }

    protected function extendWinterUserSideMenu()
    {
        Event::listen('backend.menu.extendItems', static function ($manager) {
            $manager->addSideMenuItems('Winter.User', 'user', [
                'permissions' => [
                    'label' => 'sunlab.permissions::lang.permissions.menu_label',
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

    protected function extendUserController()
    {
        Event::listen('backend.form.extendFields', function ($widget) {

            if (!$widget->getController() instanceof \Winter\User\Controllers\Users) {
                return;
            }

            if (!$widget->model instanceof \Winter\User\Models\User) {
                return;
            }

            $widget->addTabFields([
                'user_permissions' => [
                    'tab'   => 'sunlab.permissions::lang.permissions.menu_label',
                    'type'    => 'userpermissioneditor',
                    'permissions' => ['sunlab.permissions.access_user_permissions']
                ]
            ]);
        });
    }

    protected function extendUserGroupController()
    {
        Event::listen('backend.form.extendFields', function ($widget) {

            if (!$widget->getController() instanceof \Winter\User\Controllers\UserGroups) {
                return;
            }

            if (!$widget->model instanceof \Winter\User\Models\UserGroup) {
                return;
            }

            $widget->addTabFields([
                'user_permissions' => [
                    'tab'   => 'sunlab.permissions::lang.permissions.menu_label',
                    'type'    => 'userpermissioneditor',
                    'permissions' => ['sunlab.permissions.access_user_permissions']
                ]
            ]);
        });
    }
}
