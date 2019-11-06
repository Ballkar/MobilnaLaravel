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
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('announcement_types');
            $table->string('name')->nullable();
            $table->text('description');
            $table->boolean('is_mobile')->default(false);
            $table->integer('mobile_price')->default(0);
            $table->integer('mobile_distance')->nullable();

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
