<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogPostsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts_images', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('main')->default(0);
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('blog_posts');
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
