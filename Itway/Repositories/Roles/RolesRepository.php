<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/19/2015
 * Time: 1:08 PM
 */

namespace Itway\Repositories\Roles;

use Itway\Repositories\Repository;

interface RolesRepository extends Repository{

    public function update($data, $dataPerm, $role);
}