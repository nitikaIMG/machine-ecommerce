<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_no');

            $table->foreignId('cart_id')
                ->constrained('carts')
                ->onDelete('restrict');

            $table->timestamps();
        });

        Schema::create('order_sellers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');

            $table->foreignId('seller_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('status', 50)
                ->default('quotation')
                ->comment('quotation,pending,confirmed,delivered');

            $table->timestamps();
        });

        Schema::create('cart_item_biddings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_item_id')
                ->constrained('cart_items')
                ->onDelete('cascade');

            $table->foreignId('customer_id')
                ->comment('person who placed this bid')
                ->constrained('users')
                ->onDelete('cascade');    

            $table->foreignId('seller_id')
                ->comment('person who accepts/rejects this bid')
                ->constrained('users')
                ->onDelete('cascade');

            $table->decimal('bid');

            $table->boolean('accepted')
                ->comment('-1 rejected, 0 no-action, 1 accepted')
                ->default(0);

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
        Schema::dropIfExists('orders');
    }
}
