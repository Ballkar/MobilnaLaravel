<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalendarActionPeriodic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_action_periodic', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('calendar_action_types');

            $table->bigInteger('announcement_id')->unsigned();
            $table->foreign('announcement_id')->references('id')->on('announcements');

            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->unsignedInteger('week_day');
            $table->unsignedInteger('start_hour');
            $table->unsignedInteger('start_minute');
            $table->unsignedInteger('end_hour');
            $table->unsignedInteger('end_minute');
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
