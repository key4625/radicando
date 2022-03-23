<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Diary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cultivation_id')->nullable();
            $table->bigInteger('operationtype_id');
            $table->bigInteger('field_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('tool')->nullable();
            $table->double('surface')->nullable();
            $table->double('quantity')->nullable();
            $table->time('duration')->nullable();  
            $table->date('date_start');
            $table->date('date_end')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operationtype');
        Schema::dropIfExists('operations');
    }
}
