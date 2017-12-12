<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSessionStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('game_session_statistics'))
            Schema::create('game_session_statistics', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('user_id');
                $table->integer('is_online');
                $table->dateTime('login_at');
                $table->dateTime('logout_at');
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
        Schema::dropIfExists('game_session_statistics');
    }
}
