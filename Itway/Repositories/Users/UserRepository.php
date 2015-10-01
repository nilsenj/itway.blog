<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/22/2015
 * Time: 11:19 PM
 */

namespace Itway\Repositories\Users;


use Itway\Repositories\Repository;

interface UserRepository extends Repository
{
    public function getRole($user);
    public function banORunBan($id);
}