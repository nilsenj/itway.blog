<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/22/2015
 * Time: 11:20 PM
 */

namespace Itway\Repositories\Users;

use itway\User;

class EloquentUserRepository implements UserRepository
{
    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = User::class;

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
        $search = $this->getModel()->search($searchQuery)
        ->with('posts')
        ->get();

        return $search;
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
        $user = $this->findById($id);
        if (!is_null($user)) {
            $user->delete();
            return true;
        }
        return false;
    }
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }
    public function getRole($user) {

        foreach ($user->roles()->get() as $role) {
            {
                       return $role->name;
            }
        }
    }
}