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
                $table->timestamp('login_at');
                $table->timestamp('logout_at')->nullable();
                $table->string('ip')->nullable();
                $table->string('device_uid', 1000)->nullable();
                $table->string('os_type')->nullable();
                $table->string('os_version')->nullable();
                $table->tinyInteger('mobile')->nullable();
                $table->string('location')->nullable();
                $table->integer('agency_id')->nullable();
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
