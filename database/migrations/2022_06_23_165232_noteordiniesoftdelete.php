<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Noteordiniesoftdelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->integer('priority')->default(5);
            $table->text('description')->nullable();
            $table->softDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('priority')->default(5);
            $table->softDeletes();
        });
        Schema::table('productcategories', function (Blueprint $table) {
            $table->integer('priority')->default(5);
        });
        Schema::table('plantcategories', function (Blueprint $table) {
            $table->integer('priority')->default(5);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->text('notes')->nullable();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn(['priority']);
            $table->dropColumn(['description']);
            $table->dropSoftDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['priority']);
            $table->dropSoftDeletes();
        });
        Schema::table('productcategories', function (Blueprint $table) {
            $table->dropColumn(['priority']);
        });
        Schema::table('plantcategories', function (Blueprint $table) {
            $table->dropColumn(['priority']);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['notes']);
        });
    }
}
