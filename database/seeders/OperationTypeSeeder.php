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
            'icon' => 'operazioni.png'
        ]);
        Operationtype::create([
            'name' => "Potatura",
            'icon' => 'operazioni.png'
        ]);
        Operationtype::create([
            'name' => "Trattamento",
            'icon' => 'operazioni.png'
        ]);
        Operationtype::create([
            'name' => "Concimazione",
            'icon' => 'operazioni.png'
        ]);
        Operationtype::create([
            'name' => "Irrigazione",
            'icon' => 'operazioni.png'
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
            'name' => "Altro",
            'icon' => 'operazioni.png'
        ]);
    }
}
