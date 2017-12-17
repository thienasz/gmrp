<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSessionTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('game_session_tracker'))
            Schema::create('game_session_tracker', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('user_id');
                $table->integer('is_online')->defalut(1);
                $table->timestamp('login_at');
                $table->timestamp('logout_at')->nullable();
                $table->timestamp('last_activity')->nullable();
                $table->string('ip')->nullable();
                $table->string('browser')->nullable();
                $table->string('browser_version')->nullable();
                $table->string('platform')->nullable();
                $table->string('platform_version')->nullable();
                $table->tinyInteger('mobile')->nullable();
                $table->string('device')->nullable();
                $table->string('location')->nullable();
                $table->tinyInteger('robot')->nullable();
                $table->string('device_uid')->nullable();
                $table->string('login_code')->nullable();
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
        Schema::dropIfExists('game_session_tracker');
    }
}
