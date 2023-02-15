<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeUserIdToUserShopId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('seller_product_categories')->truncate();

        Schema::table('seller_product_categories', function (Blueprint $table) {
            $table->dropForeign('seller_product_categories_user_id_foreign');
            $table->dropColumn('user_id');

            $table->foreignId('user_shop_id')
                ->after('id')
                ->constrained('user_shops')
                ->onDelete('cascade');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_product_categories', function (Blueprint $table) {
            //
        });
    }
}
