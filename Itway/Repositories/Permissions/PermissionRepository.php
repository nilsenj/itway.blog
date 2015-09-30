<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/21/2015
 * Time: 4:15 PM
 */

namespace Itway\Repositories\Permissions;

use Itway\Repositories\Repository;

interface PermissionRepository extends Repository {

    public function update($data, $permission);
}