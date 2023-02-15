<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('seller_products', function(Blueprint $table) {

            $table->id();

            $table->foreignId('seller_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->string('price_type', 100)
                ->comment('fixed,bid');

            $table->decimal('price')
                ->comment('fixed price')
                ->nullable();

            $table->unsignedBigInteger('qty')
                ->comment('null means seller unlimited supply')
                ->nullable();
            
            $table->boolean('status')
                ->default(1);

            $table->timestamps();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                ->constrained('cart')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->unsignedInteger('qty')
                ->default(0);

            $table->decimal('amount')
                ->nullable()
                ->comment('quoted, fixed - to be set when quotation is sent by customer');

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
        Schema::dropIfExists('cart');
    }
}
