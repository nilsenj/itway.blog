<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilerTable extends Migration {

    public function up()
    {
        Schema::create('nilsenj_profiler', function($table)
        {
            $table->increments('id');
            $table->string('project_code', 10)->nullable();
            $table->string('controller', 100);
            $table->string('route', 100)->nullable();
            $table->string('method', 10);
            $table->string('url', 1000);
            $table->text('request_body')->nullable();
            $table->text('request_data')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('referer')->nullable();
            $table->string('agent', 1000)->nullable();
            $table->string('cookie', 1000)->nullable();
            $table->string('ip_address', 64)->nullable();
            $table->float('response_time')->unsigned();
            $table->bigInteger('memory_usage');
            $table->datetime('idate')->nullable();
            $table->datetime('udate')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('nilsenj_profiler');
    }

}
