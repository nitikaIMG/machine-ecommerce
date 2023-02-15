<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCartIdToCartItemBiddings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('cart_item_biddings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::table('cart_item_biddings', function (Blueprint $table) {

            $table->foreignId('cart_id')
                ->after('id')
                ->constrained('carts')
                ->onDelete('cascade');

            $table->foreignId('shop_id')
                ->after('cart_id')
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
        Schema::table('cart_item_biddings', function (Blueprint $table) {
            //
        });
    }
}
