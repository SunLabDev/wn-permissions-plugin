<?php namespace SunLab\Permissions\Tests\Unit\Facades;

use SunLab\Permissions\Tests\PermissionsPluginTestCase;

class PermissionsTest extends PermissionsPluginTestCase
{
    public function testUserHasPermission()
    {
        $this->user->permissions()->attach($this->permission->id);

        $this->assertTrue($this->user->userHasPermission($this->permission->code));
    }

    public function testUserHasMultiplePermissions()
    {
        $this->user->permissions()->attach([$this->permission->id, $this->permission2->id]);

        $this->assertTrue($this->user->userHasPermission([$this->permission->code, $this->permission2->code]));
    }

    public function testUserHasAtLeastOnePermission()
    {
        $this->user->permissions()->attach($this->permission->id);

        $this->assertTrue($this->user->userHasPermission([$this->permission->code, $this->permission2->code], 'one'));
    }

    public function testUserHasPermissionsAtAGroupLevel()
    {
        $this->user->groups()->first()->permissions()->attach($this->permission->id);

        $this->assertTrue($this->user->userHasPermission($this->permission->code));
    }

    public function testPermissionsCanBeMixedBetweenUserAndGroupLevel()
    {
        $this->user->groups()->first()->permissions()->attach($this->permission->id);
        $this->user->attach($this->permission2->id);

        $this->assertTrue($this->user->userHasPermission([$this->permission->code, $this->permission2->code]));
    }
}
