<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('user_data', function(Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('name')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('state')->nullable();
//            $table->string('city')->nullable();
//            $table->string('road')->nullable();
//            $table->string('house_number')->nullable();
//            $table->string('flat_number')->nullable();
//            $table->string('additional')->nullable();
//            $table->bigInteger('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
