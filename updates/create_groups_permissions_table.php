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
            $table->unsignedInteger('user_group_id');
            $table->unsignedInteger('permission_id');
            $table->primary(['user_group_id', 'permission_id']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sunlab_permissions_groups_permissions');
    }
}
