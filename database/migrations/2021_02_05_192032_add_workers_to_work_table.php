<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkersToWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendar_works', function (Blueprint $table) {
            $table->bigInteger('worker_id')->unsigned()->nullable();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('set null');
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
