<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_settings', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->integer('hour')->default(9);
            $table->integer('minute')->default(0);

            $table->boolean('day_before')->default(true);
            $table->boolean('same_day')->default(false);
            $table->boolean('messages_active')->default(false);

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
