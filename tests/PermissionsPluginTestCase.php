<?php namespace SunLab\Permissions\Tests;

use PluginTestCase;
use SunLab\Permissions\Models\Permission;
use Winter\User\Facades\Auth;
use Winter\User\Models\UserGroup;

abstract class PermissionsPluginTestCase extends PluginTestCase
{
    protected $user;

    protected $permission;
    protected $permission2;

    public function setUp(): void
    {
        parent::setUp();

        $this->getPluginObject()->boot();

        // Create a base user model for the tests
        $this->user = Auth::register([
            'username' => 'username',
            'email' => 'user@user.com',
            'password' => 'abcd1234',
            'password_confirmation' => 'abcd1234'
        ], true);

        $this->user->groups()->attach(UserGroup::first()->id);

        // Create base permission models for the tests
        $this->permission = new Permission;
        $this->permission->label = 'Base permission';
        $this->permission->code = 'base-permission';
        $this->permission->tab = 'tab';
        $this->permission->save();

        $this->permission2 = new Permission;
        $this->permission2->label = 'Base permission2';
        $this->permission2->code = 'base-permission-2';
        $this->permission2->tab = 'tab';
        $this->permission2->save();
    }
}
