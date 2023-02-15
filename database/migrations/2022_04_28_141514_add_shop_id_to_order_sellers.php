<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddShopIdToOrderSellers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_sellers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::table('order_sellers', function (Blueprint $table) {
            $table->foreignId('shop_id')
                ->after('seller_id')
                ->constrained('user_shops')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_sellers', function (Blueprint $table) {
            //
        });
    }
}
