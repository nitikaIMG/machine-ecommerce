<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CartChangeProductIdToSellerProductId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('cart_items')->truncate();

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('cart_items_product_id_foreign');
            $table->dropForeign('cart_items_user_shop_id_foreign');

            $table->dropColumn('product_id');
            $table->dropColumn('user_shop_id');

            $table->foreignId('seller_product_id')
                ->after('cart_id')
                ->constrained('seller_products')
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
        Schema::table('cart_items', function (Blueprint $table) {
            //
        });
    }
}
