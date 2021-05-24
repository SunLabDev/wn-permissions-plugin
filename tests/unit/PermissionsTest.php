<?php namespace SunLab\Permissions\Tests\Unit\Facades;

use SunLab\Permissions\Tests\PermissionsPluginTestCase;

class PermissionsTest extends PermissionsPluginTestCase
{
    public function testUserHasPermission()
    {
        $this->user->permissions()->attach($this->permission);

        $this->assertTrue($this->user->userHasPermission('base-permission'));
    }

    public function testUserHasMultiplePermissions()
    {
        $this->user->permissions()->attach($this->permission);

        $this->assertTrue($this->user->userHasPermission(['base-permission', 'base-permission-2']));
    }

    public function testUserHasAtLeastOnePermission()
    {
        $this->user->permissions()->attach($this->permission);

        $this->assertTrue($this->user->userHasPermission(['base-permission', 'base-permission-2'], 'one'));
    }
}
