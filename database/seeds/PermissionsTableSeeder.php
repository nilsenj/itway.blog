<?php

use Illuminate\Database\Seeder;
use itway\Permission;
use itway\Role;
use itway\User;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!Permission::find(1)) {

            $permissionsAdmin = array(
                'Manage Pages',
                'Manage Settings',
                'Manage Roles',
                'Manage Permissions',
                'See all Sales',
                'Manage Customers',
                'Manage Sells',
                'Manage Categories',
                'Set Prices',
                'Manage Profile',
                'Buy Goods',
                'Share Goods',

            );
            foreach ($permissionsAdmin as $permission) {
                $perm = Permission::updateOrCreate([
                    'name' => $permission,
                    'display_name' => $permission,
                    'description' => $permission,

                ]);
                $roleAdmin = Role::find(1);

                $roleAdmin->attachPermission($perm, new Role);

            }
            $listIds = Permission::all()->lists('id');
            $roleManager = Role::find(2);
            foreach ($listIds as $key => $permission) {
                if ( $key >= 5 && $key <= 8)



                $roleManager->attachPermission(Permission::find($permission));

            }


            $roleCustomer = Role::find(3);

            foreach ($listIds as $key => $permission) {
                if ( $key >= 9 && $key <= 11)

                $roleCustomer->attachPermission(Permission::find($permission));

            }

        }



    }

}
