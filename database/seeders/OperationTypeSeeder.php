<?php

namespace Database\Seeders;

use App\Models\Operationtype;
use Illuminate\Database\Seeder;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operationtype::create([
            'name' => "Lavorazione del terreno",
            'icon' => 'movimento_terra_image.png'
        ]);
        Operationtype::create([
            'name' => "Potatura",
            'icon' => 'potatura_image.png'
        ]);
        Operationtype::create([
            'name' => "Trattamento",
            'icon' => 'trattamento_image.png'
        ]);
        Operationtype::create([
            'name' => "Concimazione",
            'icon' => 'concimazione_image.png'
        ]);
        Operationtype::create([
            'name' => "Irrigazione",
            'icon' => 'irrigazione_image.png'
        ]);
        Operationtype::create([
            'name' => "Trapianto",
            'icon' => 'operazioni.png',
            'visible' => '0'
        ]);
        Operationtype::create([
            'name' => "Semina",
            'icon' => 'operazioni.png',
            'visible' => '0'
        ]);
        Operationtype::create([
            'name' => "Analisi chimica",
            'icon' => 'analisi chimica_image.png'
        ]);
        Operationtype::create([
            'name' => "Altro",
            'icon' => 'manutenzione_image.png'
        ]);
        
    }
}
