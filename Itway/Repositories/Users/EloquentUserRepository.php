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
    /**
     * paginate by this number
     *
     * @return int
     */
    public function perPage()
    {
        return 10;
    }

    /**
     * get the model
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = User::class;

        return new $model;
    }

    /**
     * fetch all users or search
     *
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {

            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * fetch all users
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    /**
     * simple search for the users
     *
     * @param mixed $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('Email', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
    }

    /**
     * find the user by id
     *
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * find by selected field
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    /**delete selected user
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $user = $this->findById($id);
        if (!is_null($user)) {
            $user->delete();
            return true;
        }
        return false;
    }

    /**
     * simple create method
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * fetch user's role name
     *
     * @param $user
     * @return mixed
     */
    public function getRole($user) {

        foreach ($user->roles()->get() as $role) {
            {
                return [$role->id, $role->name];
            }
        }
    }

    /**
     * ban or unban the user
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $user = $this->findById($id);

        if ($user->banned === 0) {

            \Toastr::warning('User banned!', $title = $user->name, $options = []);

            $user->banned = true;

        }
        else {
            \Toastr::info('User unbanned!', $title = $user->name, $options = []);

            $user->banned = false;
        }

        $user->update();
    }

}