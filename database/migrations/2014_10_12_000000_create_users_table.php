<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('reg')->default(false);
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamp('birth_date')->nullable();

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('road')->nullable();
            $table->string('house_number')->nullable();
            $table->string('flat_number')->nullable();

            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');

            $table->string('avatar')->nullable();
            $table->string('avatar_thumbnail')->nullable();

            $table->json('tutorials')->default('[]');

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
