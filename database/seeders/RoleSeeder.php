<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'name' => 'Admin',
            'description' => 'Description for Admin Role',
        ]);
        \App\Models\Role::create([
            'name' => 'Manager',
            'description' => 'Department manager with elevated permissions',
        ]);
        \App\Models\Role::create([
            'name' => 'Staff',
            'description' => 'General staff member with standard permissions',
        ]);
    }
}
