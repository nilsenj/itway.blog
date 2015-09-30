<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_post', function(Blueprint $table){

            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('picture_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('picture_post', function(Blueprint $table){
            $table->dropForeign('picture_post_post_id_foreign');
            $table->dropForeign('picture_post_picture_id_foreign');
        });
    }
}
