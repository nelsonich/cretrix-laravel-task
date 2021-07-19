<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => User::ROLE_ADMIN,
            'name' => "Admin Admin",
            'email' => "admin@admin.com",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role' => User::ROLE_EMPLOYEE,
            'name' => "Employee 1",
            'email' => "employee@mail.com",
            'password' => Hash::make('00000000'),
        ]);
    }
}
