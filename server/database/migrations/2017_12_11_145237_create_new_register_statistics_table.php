<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewRegisterStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('new_register_statistics'))
            Schema::create('new_register_statistics', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('user_id');
                $table->integer('agency_id');
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
        Schema::dropIfExists('new_register_statistics');
    }
}
