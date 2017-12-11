<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_details'))
            Schema::create('user_details', function (Blueprint $table){
                $table->increments('userDetailsID');
                $table->string('firstname');
                $table->string('lastname');
                $table->date('date_of_birth');
                $table->boolean('gender')->default(1);
                $table->string('phone');
                $table->integer('cityID');
                $table->integer('districtID');
                $table->longText('address');
                $table->integer('userID');
                $table->boolean('status')->default(1);
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
        Schema::dropIfExists('user_details');
    }
}