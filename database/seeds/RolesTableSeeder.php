<?php

use Illuminate\Database\Seeder;
use itway\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::find(1)) {
            Role::create([
                'name' => 'Admin',
                'display_name' => 'admin',
                'description' => 'can manage admin panel, add, delete, update', // optional
            ]);

            Role::create([
                'name' => 'Manager',
                'display_name' => 'manager',
                'description' => 'can be present in admin panel, can\'t delete users but can delete theirs info', // optional
            ]);

            Role::create([
                'name' => 'Client',
                'display_name' => 'Client',
                'description' => 'can manage his profile,can\'t be present in admin panel', // optional
            ]);
        }
    }
}
