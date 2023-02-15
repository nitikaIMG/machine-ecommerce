<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShopName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_companies', function (Blueprint $table) {
            $table->string('shop_name')
                ->nullable()
                ->after('user_id');

            $table->string('shop_contact')
                ->nullable()
                ->after('shop_name');

            $table->string('shop_email')
                ->nullable()
                ->after('shop_contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_companies', function (Blueprint $table) {
            //
        });
    }
}
