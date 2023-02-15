<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsForShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_companies', function (Blueprint $table) {
            $table->time('working_hours_from')
                ->nullable();

            $table->time('working_hours_to')
                ->nullable();

            $table->string('working_days')
                ->comment('Su,M,T,W,T,F,S')
                ->nullable();

            $table->string('registration_no')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->boolean('is_primary')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_companies', function (Blueprint $table) {
            //
        });
    }
}
