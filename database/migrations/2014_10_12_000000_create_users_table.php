<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')
                ->comment('admin,sub-admin,buyer,sub-buyer,seller');

            $table->string('name');

            $table->string('email')->unique();

            $table->string('phone')->unique();

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->string('otp', 10)
                ->nullable();

            $table->timestamp('otp_verified_at')
                ->nullable();

            $table->string('latitude')
                ->nullable();

            $table->string('longitude')
                ->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_companies', function(Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('registration_no');

            $table->string('country')
                ->comment('iso3');

            $table->string('state')
                ->comment('isocode');

            $table->text('address_1')
                ->nullable();

            $table->text('address_2')
                ->nullable();
            
            $table->string('id_document')
                ->nullable();

            $table->boolean('is_primary')
                ->default(0);

            $table->string('latitude')
                ->nullable();

            $table->string('longitude')
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
        Schema::dropIfExists('users');
    }
}
