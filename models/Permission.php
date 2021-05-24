<?php namespace SunLab\Permissions\Models;

use Model;
use Winter\User\Models\User as UserModel;
use Winter\User\Models\UserGroup as UserGroupModel;

class Permission extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    protected $table = 'sunlab_permissions_permissions';

    public $rules = [
        'name' => 'required',
        'code' => 'required'
    ];

    public $belongsToMany = [
        'users' => [
            \Winter\User\Models\User::class,
            'table' => 'sunlab_permissions_permissions_users',
            'timestamps' => true,
            'pivot' => ['permission_state'],
        ],
        'groups' => [
            \Winter\User\Models\UserGroup::class,
            'table' => 'sunlab_permissions_groups_permissions'
        ],
    ];
}
