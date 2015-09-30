<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/21/2015
 * Time: 4:15 PM
 */

namespace Itway\Repositories\Permissions;

use itway\Permission;
use Illuminate\Encryption\Encrypter;

class EloquentPermissionRepository implements PermissionRepository{


    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = Permission::class;

        return new $model;
    }
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }
    public function getAll()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
            ;
    }
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }
    public function delete($id)
    {
        $article = $this->findById($id);
        if (!is_null($article)) {
            $article->delete();
            return true;
        }
        return false;
    }
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }
    public function update($data, $permission) {

        $permission->update($data);

    }

}