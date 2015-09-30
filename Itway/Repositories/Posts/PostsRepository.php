<?php

namespace Itway\Repositories\Posts;


use Itway\Repositories\Repository;
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/20/2015
 * Time: 1:54 AM
 */
interface PostsRepository  extends Repository
{
    public function getModel();
    public function allOrSearchUsers();
    public function getAllUsers();
    public function countUserPosts();

}