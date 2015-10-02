<?php namespace Nilsenj\Profiler;

use Eloquent;

class ProfilerModel extends Eloquent {
	protected $table = 'nilsenj_profiler';
    const CREATED_AT = 'idate';
    const UPDATED_AT = 'udate';
}