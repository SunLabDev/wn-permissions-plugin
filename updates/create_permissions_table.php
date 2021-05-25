<?php namespace SunLab\Permissions\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_permissions_permissions', static function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('label');
            $table->string('comment')->nullable();
            $table->string('tab');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sunlab_permissions_permissions');
    }
}
