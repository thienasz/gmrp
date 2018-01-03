<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('payments'))
            Schema::create('payments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('game_id');
                $table->integer('user_id');
                $table->integer('agency_id')->nullable();
                $table->integer('pay_card_type');
                $table->float('pay_price', 16);
                $table->text('description');
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
        Schema::dropIfExists('payments');
    }
}
