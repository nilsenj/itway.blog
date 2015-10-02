<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('preamble');
			$table->string('image');
			$table->longText('body');
            $table->string('slug');
            $table->string('locale');
            $table->integer('comment_count')->unsigned();
			$table->timestamps();
			$table->timestamp('published_at');
			$table->timestamp('date')->default(Carbon::today());
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts', function(Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
        });

    }

}
