<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MarkColumnsUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('orders')->truncate();
        DB::table('order_sellers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::table('order_sellers', function (Blueprint $table) {
            $table->unique(['order_id', 'seller_id', 'shop_id']);
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
