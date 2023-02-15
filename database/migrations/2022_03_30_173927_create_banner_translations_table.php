<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale', 10)->index();

            $table->foreignId('banner_id')
                ->constrained('banners')
                ->onDelete('cascade');

            // translatable columns
            $table->string('title')->nullable();

            $table->text('short_description')->nullable();

        });
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('short_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_translations');
    }
}
