<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shop_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale', 10)->index();

            $table->foreignId('user_shop_id')
                ->constrained('user_shops')
                ->onDelete('cascade');

            // translatable columns
            $table->string('overview')->nullable();

            $table->text('services')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shop_translations');
    }
}
