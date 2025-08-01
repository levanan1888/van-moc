<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('author_id');
            $table->string('author_type', 255);
            $table->string('template', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('customers_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('customers_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'customers_id'], 'customers_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_translations');
    }
}
