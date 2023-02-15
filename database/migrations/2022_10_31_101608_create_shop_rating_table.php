<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_rating', function (Blueprint $table) {
            $table->id();
            $table->integer('rate');
            $table->text('review')->nullable();
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users');

            $table->bigInteger('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('user_shops');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_rating');
    }
}
