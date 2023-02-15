<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')
                ->default(0);

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::table('product_categories', function (Blueprint $table) {

            $table->foreignId('parent_id')
                ->nullable()
                ->after('id')
                ->constrained('product_categories')
                ->onDelete('set null');
        });

        Schema::create('product_category_translations', function(Blueprint $table) {
            $table->id();

            $table->string('locale', 10)->index();

            $table->foreignId('product_category_id')
                ->constrained('product_categories')
                ->onDelete('cascade');

            // translatable columns
            $table->string('title');

            $table->text('short_description')->nullable();

            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
