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

            $table->bigInteger('schema_id')->unsigned();
            $table->foreign('schema_id')->references('id')->on('message_schemas');

            $table->integer('hour');
            $table->integer('minute');

            $table->string('time_type');
            $table->boolean('active');

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
