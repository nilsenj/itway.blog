<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/27/2015
 * Time: 11:19 PM
 */

namespace Itway\Traits;

use itway\Counter;
use itway\UserCounter;

trait ViewCounterTrait {

//    public function scopeMostViewed($query)
//    {
//        return $query->hasMany(Counter::class)->whereObjectId($this->id)->whereClassName(snake_case(get_class($this)))->view_counter;
//    }
    public function counter()
    {
        if(!isset($this->counter))
        {
            $class_name = snake_case(get_class($this));
            $this->counter = Counter::firstOrCreate(array('class_name' => $class_name, 'object_id' => $this->id));
        }
        return $this->counter;
    }
    public function user_counters()
    {
        return $this->hasMany(UserCounter::class, 'object_id')->where('class_name', snake_case(get_class($this)));
    }

    /**
     * Return authentificated users who viewed we know
     *
     * @return Integer
     */

    public function view()
    {
        if(!$this->isViewed())
        {
            if(\Auth::user())
            {
                $this->user_counters()->create(array(
                    'class_name' => snake_case(get_class($this)),
                    'object_id' => $this->id,
                    'user_id' => \Auth::user()->id,
                    'action' => 'view'
                ));
                $this->counter()->increment('view_counter');

                return true;
            } else {
                \Session::put($this->get_view_key(), time());
                $this->counter()->increment('view_counter');

                return true;
            }
        }
        return false;
    }
    /**
     * Return views count
     *
     * @return Integer
     */
    public function views_count()
    {
        return $this->counter()->view_counter;
    }
    /**
     * Is object already viewed by user?
     *
     * @return Boolean
     */
    public function isViewed()
    {
        if(!\Auth::user())
        {
            $viewed = \Session::get($this->get_view_key());
            if(!empty($viewed)) {
                return true;
            }
        } else {
            $user_action = $this->user_counters()
                ->where('action', 'view')
                ->where('class_name', snake_case(get_class($this)))
                ->where('object_id', $this->id)
                ->where('user_id', \Auth::user()->id)->count();
            if($user_action > 0)
                return true;
        }
        return false;
    }
    /**
     * get session storage key for view
     *
     * @return String
     */
    private function get_view_key()
    {
        return 'viewed_'.snake_case(get_class($this)).'_'.$this->id;
    }

}