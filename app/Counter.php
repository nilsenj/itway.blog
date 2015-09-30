<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counter';
    protected $fillable = array('class_name', 'object_id');
}
