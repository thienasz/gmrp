<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenueAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('revenue_agency'))
            Schema::create('revenue_agency', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('agency_id');
                $table->integer('percent_share');
                $table->dateTime('total_user');
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
        Schema::dropIfExists('revenue_agency');
    }
}
