<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('locale');
            $table->string('slug')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('Google')->unique()->nullable();
            $table->string('Facebook')->unique()->nullable();
            $table->string('Github')->unique()->nullable();
            $table->string('Twitter')->unique()->nullable();
            $table->boolean('banned')->default(false);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::drop('users');
    }
}
