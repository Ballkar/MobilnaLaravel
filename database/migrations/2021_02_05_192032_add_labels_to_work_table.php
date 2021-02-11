<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelsToWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendar_works', function (Blueprint $table) {
            $table->bigInteger('label_id')->unsigned()->nullable();
            $table->foreign('label_id')->references('id')->on('calendar_labels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_works', function (Blueprint $table) {
            $table->dropColumn('worker_id');
        });
    }
}
