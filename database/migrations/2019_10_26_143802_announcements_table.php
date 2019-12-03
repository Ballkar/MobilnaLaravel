<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->bigInteger('type_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('description');
            $table->boolean('is_mobile')->default(false);
            $table->integer('mobile_price')->default(0);
            $table->integer('mobile_distance')->nullable();

            $table->bigInteger('main_image')->unsigned()->nullable();
            $table->foreign('main_image')->references('id')->on('images');
            $table->string('state');
            $table->string('city');
            $table->string('road')->nullable();
            $table->string('house_number')->nullable();
            $table->string('flat_number')->nullable();

            $table->timestamps();
        });
    }

    /**`
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
