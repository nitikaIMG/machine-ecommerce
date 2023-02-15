<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@machine.com',
            'role'=>'admin',
            'phone'=>'9900990099',
            'password' => Hash::make('machine@123'),

        ]);
    }
}
