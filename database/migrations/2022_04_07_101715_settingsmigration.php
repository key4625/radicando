<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settingsmigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
          
            $table->string('name')->primary();
            $table->string('value')->nullable(); 
            $table->string('type');
            $table->timestamps();
        });
        Schema::create('plantcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image'); 
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviazione')->unique();
            $table->string('nome');
            $table->string('razza')->nullable();
            $table->string('specie')->nullable();
            $table->text('trattamenti_consigliati')->nullable();
            $table->text('richieste_nutrizionali')->nullable();
            $table->json('prodotti_utilizzabili')->nullable();
            $table->string('image')->nullable();   
            $table->string('color')->default("#3388ff");
            $table->string('border_color')->default("#3388ff");
            $table->string('icon')->nullable();
            $table->double('quantity')->default(0);
            $table->boolean('vendibile')->nullable();
            $table->double('prezzo_kg')->default(0.0);
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
        Schema::dropIfExists('settings');
        Schema::dropIfExists('plantcategories');
    }
}
