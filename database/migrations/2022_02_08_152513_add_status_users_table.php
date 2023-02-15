<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
             $table->tinyInteger('status')
                ->default(1)
                ->comment('1=Active,0=Blocked')->after('otp_verified_at');
                
            $table->tinyInteger('vendor_verified')
                ->nullable()
                ->comment('1=approved, 0=denied')->after('status');
        });
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
