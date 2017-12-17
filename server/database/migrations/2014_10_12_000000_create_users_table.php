<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users'))
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('username')->nullable();
                $table->string('fb_uid')->nullable();
                $table->string('fb_token', 1000)->nullable();
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->string('game_id')->nullable();
                $table->string('agency_id')->nullable();
                $table->boolean('role')->default(0);
                $table->rememberToken();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
