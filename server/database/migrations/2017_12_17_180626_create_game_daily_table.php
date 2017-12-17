<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_daily_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('total_active_user')->default(0);
            $table->integer('total_register_user')->default(0);
            $table->float('total_revenue')->default(0);
            $table->float('total_agency')->default(0);

            $table->string('day_report');
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
        Schema::dropIfExists('game_daily_report');
    }
}
