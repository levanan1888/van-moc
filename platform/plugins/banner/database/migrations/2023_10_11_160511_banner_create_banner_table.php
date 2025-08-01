<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('published');
            $table->string('description')->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('author_id');
            $table->string('author_type', 255);
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->tinyInteger('order')->unsigned()->default(0);
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('banners_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('banners_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'banners_id'], 'banners_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('banners_translations');
    }
};
