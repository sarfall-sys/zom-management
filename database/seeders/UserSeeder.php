<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::updateOrCreate([
            'email' => 'admin@test.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('Password.123'),
            'role_id' => User::ROLE_ADMIN,
        ]);

        User::updateOrCreate([
            'email' => 'manager@test.com',
        ], [
            'name' => 'Manager User',
            'password' => bcrypt('Password.123'),
            'role_id' => User::ROLE_MANAGER,
        ]);

        User::updateOrCreate([
            'name' => 'Staff User',
            'email' => 'staff@test.com',
            'password' => bcrypt('Password.123'),
            'role_id' => User::ROLE_STAFF,
        ]);
        User::factory(10)->create();

    }
}
