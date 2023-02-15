<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoreProductFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('price_type', 100)
                ->comment('bid,fixed')
                ->after('cover_image')
                ->nullable();

            $table->decimal('fixed_price', 8, 2)
                ->after('price_type')
                ->nullable();

            $table->char('country', 3)
                ->comment('iso3 code')
                ->after('fixed_price')
                ->nullable();

            $table->string('state')
                ->comment('state name')
                ->after('country')
                ->nullable();

            $table->string('region')
                ->comment('region name')
                ->after('state')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
