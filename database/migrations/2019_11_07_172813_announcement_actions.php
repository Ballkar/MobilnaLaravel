<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_actions', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('announcement_action_types');

            $table->bigInteger('announcement_id')->unsigned();
            $table->foreign('announcement_id')->references('id')->on('announcements');

            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('road')->nullable();
            $table->string('house_number')->nullable();
            $table->string('flat_number')->nullable();

            $table->text('additional_info')->nullable();


            $table->boolean('is_mobile')->default(false);
            $table->boolean('done')->default(false);

            $table->json('services');
            $table->integer('income');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
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
