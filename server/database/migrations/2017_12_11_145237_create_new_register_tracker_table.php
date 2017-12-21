<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewRegisterTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('new_register_tracker'))
            Schema::create('new_register_tracker', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('user_id');
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
        Schema::dropIfExists('new_register_tracker');
    }
}
