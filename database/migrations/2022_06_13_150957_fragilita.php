<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fragilita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->integer('fragile')->default(0);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('fragile')->default(0); 
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
            $table->dropColumn(['fragile']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['fragile']);
        });
    }
}
