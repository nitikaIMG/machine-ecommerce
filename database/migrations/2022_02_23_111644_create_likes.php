<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_dislikes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('content_id');

            $table->string('content_type')
                ->comment('product,blog_post,comment');

            $table->boolean('liked')
                ->default(1);

            $table->timestamps();
        });

        Schema::create('ratings', function(Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('content_id');

            $table->string('content_type')
                ->comment('product,blog_post,comment');

            $table->unsignedTinyInteger('rating')
                ->default(1);

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
        Schema::dropIfExists('likes_ratings');
    }
}
