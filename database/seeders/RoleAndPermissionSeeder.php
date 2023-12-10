<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Make Permission for Users
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        //Make Permission for Posts
        Permission::create(['name' => 'create-posts']);
        Permission::create(['name' => 'edit-posts']);
        Permission::create(['name' => 'delete-posts']);

        //Make permission for report
        Permission::create(['name' => 'view-reports']);
        Permission::create(['name' => 'accept-reports']);
        Permission::create(['name' => 'create-reports']);

        Permission::create(['name' => 'access-dashboard']);

        //Make Role
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'access-dashboard',
            'view-reports',
            'accept-reports',
            'create-reports'
        ]);

        $writerRole->givePermissionTo([
            'create-posts',
            'edit-posts',
            'delete-posts',
            'create-reports'
        ]);

        $writer = User::factory(10)->create();
        // loop factory user
        foreach ($writer as $user) {
            $user->assignRole($writerRole);
        }

        // User::factory(10)->create()->assignRole($writerRole);
    }
}
