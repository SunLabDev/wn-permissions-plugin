<?php namespace SunLab\Permissions\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateGroupsPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_permissions_groups_permissions', static function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('permission_id');
            $table->primary(['group_id', 'permission_id'], 'group_permission_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sunlab_permissions_groups_permissions');
    }
}
