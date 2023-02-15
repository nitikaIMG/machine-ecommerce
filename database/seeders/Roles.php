<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Role::truncate();

        Role::insert([
            [
                'name' => 'superadmin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'seller',
                'guard_name' => 'web'
            ],
            [
                'name' => 'customer',
                'guard_name' => 'web'
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
