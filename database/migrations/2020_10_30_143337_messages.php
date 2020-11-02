<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('name')->nullable();
            $table->string('text')->nullable();

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
        //
    }
}
