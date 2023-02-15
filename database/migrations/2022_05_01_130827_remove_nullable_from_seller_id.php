<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveNullableFromSellerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('seller_products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::table('seller_products', function (Blueprint $table) {
            try {
                $table->dropForeign('seller_products_shop_id_foreign');
                $table->dropIndex('seller_products_shop_id_foreign');
            } catch(\Exception $e) {}

            $table->foreignId('shop_id')
                ->nullable(false)
                ->change()
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
        Schema::table('seller_products', function (Blueprint $table) {
            //
        });
    }
}
