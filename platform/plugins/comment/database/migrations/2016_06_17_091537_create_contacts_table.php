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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('content', 400)->nullable();
            $table->integer('post_id')->default(0);
            $table->integer('author_id')->default(0);
            $table->string('author_type', 255)->nullable();
            $table->string('status', 60)->default('pending');
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
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contact_replies');
    }
};
