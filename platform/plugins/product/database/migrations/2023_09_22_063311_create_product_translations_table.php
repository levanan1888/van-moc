<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products_translations')) {
            Schema::create('products_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('product_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'product_id'], 'products_translations_primary');
            });
        }

        if (!Schema::hasTable('pcategories_translations')) {
            Schema::create('pcategories_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('products_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'products_id'], 'pcategories_translations_primary');
            });
        }

        if (!Schema::hasTable('ptags_translations')) {
            Schema::create('ptags_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->integer('tags_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'tags_id'], 'ptags_translations_primary');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_translations');
        Schema::dropIfExists('pcategories_translations');
        Schema::dropIfExists('ptags_translations');
    }
}
