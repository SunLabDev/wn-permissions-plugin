<?php namespace SunLab\Permissions\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreatePermissionsUsersTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_permissions_permissions_users', static function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
            $table->primary(['user_id', 'permission_id'], 'permissions_users_primary');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sunlab_permissions_permissions_users');
    }
}
