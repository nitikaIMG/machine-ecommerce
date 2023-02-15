<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale', 10)->index();

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            // translatable columns
            $table->string('title');

            $table->text('short_description')->nullable();

            $table->text('description')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('short_description');
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
    }
}
