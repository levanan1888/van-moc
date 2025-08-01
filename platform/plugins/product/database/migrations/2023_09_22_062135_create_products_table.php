<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description')->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255);
            $table->string('icon', 60)->nullable();
            $table->string('banner', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->string('image_size', 255)->nullable();
            $table->string('image_color', 255)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('home_order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('ptags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->integer('author_id');
            $table->string('author_type', 255);
            $table->string('description', 400)->nullable()->default('');
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 100);
            $table->string('description')->nullable();
            $table->string('feature')->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255);
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('video', 255)->nullable();
            $table->string('video_poster', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('order')->default(1000);
            $table->string('images')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->unsigned()->references('id')->on('ptags')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned()->references('id')->on('pcategories')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product_tags');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('pcategories');
        Schema::dropIfExists('ptags');
    }
}
