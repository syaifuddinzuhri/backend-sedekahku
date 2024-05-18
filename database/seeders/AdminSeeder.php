<?php

namespace Database\Seeders;

use App\Constants\GlobalConstant;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'role' => 'super-admin',
            'name' => 'Super Administrator',
            'email' => 'superadmin@gmail.com',
            'password' => 'Superadmin2024'
        ]);
        User::create([
            'role' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => 'Admin2024'
        ]);
    }
}
