<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActionService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_service', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('action_id')->unsigned();
            $table->foreign('action_id')->references('id')->on('announcement_actions');

            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('announcement_services');

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
