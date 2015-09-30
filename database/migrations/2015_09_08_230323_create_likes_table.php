<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('likeable');
            $table->morphs('liked_by');
            $table->timestamps();

            $table->unique([
                'likeable_id', 'likeable_type',
                'liked_by_id', 'liked_by_type',
            ], 'likes_unique');
        });

        Schema::create('likes_counter', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('likeable');
            $table->integer('count')->unsigned()->default(0);
            $table->timestamps();

            $table->unique([
                'likeable_id', 'likeable_type',
            ], 'likeable_counts');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('likes');
        Schema::dropIfExists('likes_counter');

    }
}
