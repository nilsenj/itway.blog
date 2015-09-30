<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.09.2015
 * Time: 2:13
 */

namespace Itway\Contracts\Likeable;

use Illuminate\Database\Eloquent\Model;

interface Likeable {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes();

    /**
     * @return mixed
     */
    public function likeCounter();

    /**
     * @return mixed
     */
    public function getLikeCount();

    /**
     * @param $from
     * @param null $to
     *
     * @return mixed
     */
    public function getLikeCountByDate($from, $to = null);

    /**
     * @return mixed
     */
    public function getLikeCountAttribute();

    /**
     * @param Model $likedBy
     *
     * @return mixed
     */
    public function shouldLike(Model $likedBy);

    /**
     * @param Model $likedBy
     *
     * @return mixed
     */
    public function dislike(Model $likedBy);

    /**
     * @param $query
     * @param Model $model
     *
     * @return mixed
     */
    public function scopeWhereLiked($query, Model $model);

}