<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeProductIdToSellerProductId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('user_favourite_products')->truncate();

        Schema::table('user_favourite_products', function (Blueprint $table) {
            $table->dropForeign('user_favourite_products_product_id_foreign');

            $table->dropColumn('product_id');

            $table->foreignId('seller_product_id')
                ->after('user_id')
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
        Schema::table('user_favourite_products', function (Blueprint $table) {
            //
        });
    }
}
