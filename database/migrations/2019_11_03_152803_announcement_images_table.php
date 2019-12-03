<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_images', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('main')->default(0);
            $table->bigInteger('announcement_id')->unsigned();
            $table->foreign('announcement_id')->references('id')->on('announcements');
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
