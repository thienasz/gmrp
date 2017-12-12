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
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->date('date_of_birth');
                $table->boolean('gender')->default(1);
                $table->string('phone');
                $table->longText('address');
                $table->integer('user_id');
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