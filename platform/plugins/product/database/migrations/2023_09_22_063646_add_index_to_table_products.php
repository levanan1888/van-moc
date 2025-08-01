<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('status', 'status');
            $table->index('author_id', 'author_id');
            $table->index('author_type', 'author_type');
            $table->index('created_at', 'created_at');
        });

        Schema::table('pcategories', function (Blueprint $table) {
            $table->index('parent_id', 'parent_id');
            $table->index('status', 'status');
            $table->index('created_at', 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('status');
            $table->dropIndex('author_id');
            $table->dropIndex('author_type');
            $table->dropIndex('created_at');
        });

        Schema::table('pcategories', function (Blueprint $table) {
            $table->dropIndex('parent_id');
            $table->dropIndex('status');
            $table->dropIndex('created_at');
        });
    }
}
