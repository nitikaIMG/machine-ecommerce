<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserCompanyToUserShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('user_companies', 'user_shops');
        Schema::rename('user_company_photos', 'user_shop_photos');

        Schema::table('user_shop_photos', function (Blueprint $table) {
            $table->renameColumn('user_company_id','user_shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('user_shops', 'user_companies');
        Schema::rename('user_shop_photos', 'user_company_photos');

        Schema::table('user_company_photos', function (Blueprint $table) {
            $table->renameColumn('user_shop_id','user_company_id');
        });
    }
}
