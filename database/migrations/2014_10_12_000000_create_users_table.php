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
            $table->string('voivodeship')->nullable();
            $table->string('city')->nullable();
            $table->string('road')->nullable();
            $table->string('house_number')->nullable();
            $table->string('flat_number')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamp('birth_date')->nullable();

            $table->string('avatar')->nullable();
            $table->string('avatar_thumbnail')->nullable();


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
