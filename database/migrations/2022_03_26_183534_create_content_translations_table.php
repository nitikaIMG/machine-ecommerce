<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale', 10)->index();

            $table->foreignId('content_id')
                ->constrained('contents')
                ->onDelete('cascade');

            // translatable columns
            $table->string('title')->nullable();
            $table->string('slug')->nullable();

            $table->text('page_content')->nullable();

           
        });

        Schema::table('contents', function (Blueprint $table) {
           $table->dropColumn('title');
           $table->dropColumn('slug');
           $table->dropColumn('page_content');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_translations');
    }
}
