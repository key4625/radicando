<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->double('resa_pianta_kg')->nullable();
            $table->boolean('vendibile')->nullable();
            $table->double('prezzo_kg')->default(0.0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('cultivations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plant_id')->unique();
            $table->string('sigla_fila');
            $table->double('larghezza_cm')->nullable();
            $table->double('lunghezza_m')->nullable();
            $table->integer('tot_piante')->nullable();
            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->date('data')->nullable();
            $table->time('ora')->nullable();
            $table->boolean('consegna_domicilio')->nullable();
            $table->string('indirizzo')->nullable();
            $table->timestamps();
        });

        Schema::create('order_plant', function (Blueprint $table) {
            $table->bigInteger('order_id');
            $table->bigInteger('plant_id');
            $table->double('quantity_kg');
            $table->double('quantity_num');
            $table->double('price_kg');
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plant_id');
            $table->double('quantity_kg');
            $table->double('quantity_num');  
            $table->date('data')->nullable();
            $table->time('ora')->nullable();
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
        Schema::dropIfExists('plants');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cultivations');
        Schema::dropIfExists('order_plant');
        Schema::dropIfExists('collections');

    }
}
