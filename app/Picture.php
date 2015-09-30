<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{


    protected $fillable = array('path');

    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
