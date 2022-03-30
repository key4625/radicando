<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordTenantsTable extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain')->unique();
            $table->string('database')->unique();
            $table->timestamps();
        });
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviazione')->unique();
            $table->string('nome');
            $table->integer('sulla_fila')->nullable();
            $table->integer('tra_file')->nullable();
            $table->json('trapianto')->nullable();
            $table->json('semina')->nullable();
            $table->json('semina_out')->nullable();
            $table->json('raccolta')->nullable();
            $table->json('gg_campo')->nullable();
            $table->string('consumatore')->nullable();
            $table->string('stagione')->nullable();
            $table->text('trattamenti_consigliati')->nullable();
            $table->text('richieste_nutrizionali')->nullable();
            $table->string('image')->nullable();   
            $table->string('color')->default("#3388ff");
            $table->string('border_color')->default("#3388ff");
            $table->string('icon')->nullable();

        
          
            $table->timestamps();
        });
        Schema::create('operationtypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();  
            $table->boolean('visible')->default(1);  
        });
    }
}
