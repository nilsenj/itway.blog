<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.09.2015
 * Time: 2:16
 */

namespace Itway\Traits;

use itway\LikeCounter;
use itway\Like;
use Illuminate\Database\Eloquent\Model;

trait Likeable {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * @return mixed
     */
    public function likeCounter()
    {
        return $this->morphOne(LikeCounter::class, 'likeable');
    }

    /**
     * @return mixed
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param $from
     * @param null $to
     *
     * @return mixed
     */
    public function getLikeCountByDate($from, $to = null)
    {
        return Like::countByDate($this, $from, $to);
    }

    /**
     * @return int
     */
    public function getLikeCountAttribute()
    {
        return $this->likeCounter ? $this->likeCounter->count : 0;
    }

    public function like($user) {

        if ($user !== null) {

            return $this->shouldLike($user);

        }
        else {

            return false;

        }
    }
    /**
     * @param Model $likedBy
     *
     * @return bool
     */
    public function shouldLike(Model $likedBy)
    {
        if ($this->getLikedRecord($likedBy)) {
            return false;
        }

        $like = new Like();
        $like->liked_by_id = $likedBy->id;
        $like->liked_by_type = get_class($likedBy);
        $this->likes()->save($like);

        $this->incrementCounter();
        return true;
    }

    /**
     * @param Model $likedBy
     *
     * @return bool
     */
    public function dislike(Model $likedBy)
    {
        if (!$like = $this->getLikedRecord($likedBy)) {
            return false;
        }

        $like->delete();

        $this->decrementCounter();

        return true;
    }

    /**
     * @param $query
     * @param Model $model
     *
     * @return mixed
     */
    public function scopeWhereLiked($query, Model $model)
    {
        return $query->whereHas('likes', function ($query) use ($model) {
            $query->where('liked_by_id', $model->id);
            $query->where('liked_by_type', get_class($model));
        });
    }

    /**
     * @return Counter
     */
    private function incrementCounter()
    {
        if ($counter = $this->likeCounter()->first()) {
            $counter->increment('count', 1);
            $counter->save();
        } else {
            $counter = new LikeCounter();
            $counter->fill(['count' => 1]);

            $this->likeCounter()->save($counter);
        }

        return $counter;
    }

    /**
     * @return mixed
     */
    private function decrementCounter()
    {
        if ($counter = $this->likeCounter()->first()) {
            $counter->decrement('count', 1);
            $counter->count ? $counter->save() : $counter->delete();
        }

        return $counter;
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function getLikedRecord(Model $model)
    {
        return $this->likes()
            ->where('liked_by_id', $model->id)
            ->where('liked_by_type', get_class($model))
            ->first();
    }

    public function liked($user)
    {

        if ($user !== null) {

           return $this->isLiked($user);

        }
        else {

            return false;

        }
    }
    /**
     * @return bool
     */
    public function isLiked(Model $model)
    {
        if($model !== null) {
            return (bool)$this->likes()
                ->where('liked_by_id', $model->id)
                ->where('liked_by_type', get_class($model))
                ->count();
        }
        else {
            return false;
        }

    }

}