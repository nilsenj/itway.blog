<?php namespace Nilsenj\Profiler\Facades;

use Illuminate\Support\Facades\Facade;

class Profiler extends Facade {

	protected static function getFacadeAccessor() 
	{ 
		return 'nilsenj.profiler';
	}

}