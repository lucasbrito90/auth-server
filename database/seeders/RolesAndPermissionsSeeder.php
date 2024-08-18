<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $enrollment = Role::create(['name' => 'enrollment']);
//        $viewUser = Permission::create(['name' => 'view user']);
//        $editUser = Permission::create(['name' => 'edit user']);
//        $deleteUser = Permission::create(['name' => 'delete user']);
//        $createUser = Permission::create(['name' => 'create user']);
//
//        $enrollment->syncPermissions([$viewUser, $editUser, $deleteUser, $createUser]);


        $enrollment = Role::create(['name' => 'project']);
        $viewUser = Permission::create(['name' => 'view project']);
        $editUser = Permission::create(['name' => 'edit project']);
        $deleteUser = Permission::create(['name' => 'delete project']);
        $createUser = Permission::create(['name' => 'create project']);

        $enrollment->syncPermissions([$viewUser, $editUser, $deleteUser, $createUser]);
    }
}
