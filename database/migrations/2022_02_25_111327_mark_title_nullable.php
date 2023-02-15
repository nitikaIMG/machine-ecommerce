<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MarkTitleNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_category_translations', function (Blueprint $table) {
            $table->string('title')
                ->nullable()
                ->change();
        });

        Schema::table('product_translations', function (Blueprint $table) {
            $table->string('title')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_category_translations', function (Blueprint $table) {
            //
        });
    }
}
