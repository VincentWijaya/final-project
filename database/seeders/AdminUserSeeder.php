<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $permission = Permission::create(['name' => 'manage book']);
        $permission->assignRole($adminRole);
        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123456')
        ]);
        $adminUser->assignRole('Administrator');
    }
}
