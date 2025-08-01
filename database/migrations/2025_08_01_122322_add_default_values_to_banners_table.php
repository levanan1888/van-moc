<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValuesToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            // Thêm default value cho author_id và author_type
            $table->integer('author_id')->default(1)->change();
            $table->string('author_type', 255)->default('Botble\ACL\Models\User')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            // Revert lại
            $table->integer('author_id')->change();
            $table->string('author_type', 255)->change();
        });
    }
}
