<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class RemoveRoleName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('verified');
            $table->dropColumn('otp_verified');

            $table->boolean('status')
                ->default(0)
                ->change();

            $table->boolean('seller_verified')
                ->default(0)
                ->change();
        });

        (new \Database\Seeders\Roles)->run();

        (\App\Models\User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@email.com',
            'phone' => '0000000000',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('password'),
            'status' => 1
        ]))->syncRoles([\App\Vars\Roles::SUPER_ADMIN]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
