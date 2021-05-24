<?php namespace SunLab\Permissions\Tests;

use PluginTestCase;
use SunLab\Permissions\Models\Permission;
use Winter\User\Facades\Auth;

abstract class PermissionsPluginTestCase extends PluginTestCase
{
    protected $user;

    protected $permission;

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
        ]);

        // Create base permission models for the tests
        $this->permission = new Permission;
        $this->permission->name = 'Base permission';
        $this->permission->code = 'base-permission';
        $this->permission->save();

        $this->permission = new Permission;
        $this->permission->name = 'Base permission2';
        $this->permission->code = 'base-permission-2';
        $this->permission->save();
    }
}
