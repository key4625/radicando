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
            $table->bigInteger('plantcategories_id')->nullable();
            $table->string('abbreviazione')->unique();
            $table->string('nome');
            $table->json('parti_utilizzabili')->nullable();
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

            $table->double('quantity_mag')->default(0);
            $table->double('resa_pianta_kg')->nullable();
            $table->boolean('vendibile')->nullable();
            $table->double('price')->default(0.0);
            $table->string('price_um')->default("kg");
            $table->string('quantity_um')->nullable();
            $table->timestamps();
        });
        Schema::create('operationtypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();  
            $table->boolean('foranimals')->default(1);
            $table->boolean('visible')->default(1);  
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('cultivation_id')->nullable();
            $table->bigInteger('productcategories_id')->nullable();
            $table->double('quantity_from')->default(0);
            $table->double('quantity_to')->default(0);
            $table->double('quantity_mag')->default(0);
            $table->double('transform_cost')->default(0);  
            $table->string('lot')->nullable();
            $table->double('dimension')->default(0.0);
            $table->double('price')->default(0.0);
            $table->string('price_um')->default("pz");
            $table->double('yield')->default(0);  
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('quantity_um')->nullable();
            $table->boolean('vendibile')->nullable();
            $table->datetime('transform_data')->nullable();
            $table->timestamps();
        });
        
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->json('points')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->double('length')->default(0);
            $table->double('width')->default(0);
            $table->double('mq')->nullable();
            $table->timestamps();
        });
        
        Schema::create('cultivations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cultivable_id');
            $table->string('cultivable_type');
            $table->bigInteger('field_id');
            $table->string('sigla_fila')->nullable();
            $table->double('larghezza')->nullable();
            $table->double('lunghezza')->nullable();
            $table->string('varieta')->nullable();
            $table->double('superficie_tot')->nullable();
            $table->integer('tot_piante')->nullable();
            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->json('points')->nullable();
            $table->string('innesto')->nullable();
            
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome')->nullable();
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->date('data')->nullable();
            $table->time('ora')->nullable();
            $table->boolean('consegna_domicilio')->default(1);
            $table->string('indirizzo')->nullable();
            $table->string('citta')->nullable();
            $table->timestamps();
        });

        Schema::create('orderables', function (Blueprint $table) {
            $table->bigInteger('order_id');
            $table->bigInteger('orderable_id');
            $table->string('orderable_type');
            $table->double('quantity');
            $table->string('quantity_um');
            $table->double('price');
            $table->string('price_um');
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('collectionable_id');
            $table->string('collectionable_type');
            $table->string('part');
            $table->double('quantity');
            $table->string('quantity_um');  
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
