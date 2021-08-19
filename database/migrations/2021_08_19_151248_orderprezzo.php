<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orderprezzo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->double('prezzo_tot')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->integer('sconto_perc')->nullable();
            $table->boolean('evaso')->default(0);
            $table->boolean('pagato')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['prezzo_tot', 'tipo_cliente', 'sconto_perc','evaso','pagato']);
        });
    }
}
