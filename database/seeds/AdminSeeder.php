<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use itway\User;
use itway\Role;
use itway\Permission;
class AdminSeeder extends Seeder
{

    /**

     */
    public function __construct(){

    }

    /**
     *
     */
    public function run()
    {

        Model::unguard();



        $user = User::UpdateOrCreate([
            'name' => 'admin',

            'email' => 'admin@admin.com',

            'password' => 'admin1111'
            ]);

            $user->attachRole(1);


        }

//    /**
//     * @param $user
//     */
//    public function createAdmin($user) {
//
//    }

    /**
     * @param $user
     */
//    public function deleteAdmin($userAdmin) {
//
//        $this->rolesAndPermissions->deleteAdminAccess($userAdmin);
//
//    }
}
