<?php namespace SunLab\Permissions\Tests\Unit\Facades;

use Illuminate\Support\Facades\DB;
use SunLab\Permissions\Tests\PermissionsPluginTestCase;

class PermissionsTest extends PermissionsPluginTestCase
{
    public function testUserHasPermission()
    {
        $permissionsNeeded = $this->permission->code;

        $this->assertFalse($this->user->userHasPermission($permissionsNeeded));
        $this->user->permissions()->attach($this->permission->id);

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->userHasPermission($permissionsNeeded));
    }

    public function testUserHasMultiplePermissions()
    {
        $permissionsNeeded = [$this->permission->code, $this->permission2->code];

        $this->assertFalse($this->user->userHasPermission($permissionsNeeded));

        $this->user->permissions()->attach([$this->permission->id, $this->permission2->id]);

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->userHasPermission($permissionsNeeded));
    }

    public function testUserHasAtLeastOnePermission()
    {
        $permissionsNeeded = [$this->permission->code, $this->permission2->code];

        $this->assertFalse($this->user->userHasPermission($permissionsNeeded));

        $this->user->permissions()->attach($this->permission->id);

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->userHasPermission($permissionsNeeded, 'one'));
    }

    public function testUserHasPermissionsAtAGroupLevel()
    {
        $permissionsNeeded = $this->permission->code;

        $this->assertFalse($this->user->userHasPermission($permissionsNeeded));

        $this->user->groups()->first()->permissions()->attach($this->permission->id);

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->userHasPermission($permissionsNeeded));
    }

    public function testPermissionsCanBeMixedBetweenUserAndGroupLevel()
    {
        $permissionsNeeded = [$this->permission->code, $this->permission2->code];

        $this->assertFalse($this->user->userHasPermission($permissionsNeeded));

        $this->user->groups()->first()->permissions()->attach($this->permission->id);
        $this->user->permissions()->attach($this->permission2->id);

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->userHasPermission($permissionsNeeded));
    }
}
