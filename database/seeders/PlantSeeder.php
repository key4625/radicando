<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\Plantcategory;
use App\Models\Productcategory;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'plants';
        $file = base_path("database/seeders/$table".".csv");
                // store returned data into array of records
        $records = $this->import_CSV($file);
        //dd($records);
        // add each record to the posts table in DB       
        Plantcategory::create([
            'id' => 1,
            'name' => 'Verdura'
        ]);
        Plantcategory::create([
            'id' => 2,
            'name' => 'Frutta'
        ]);
        Plantcategory::create([
            'id' => 3,
            'name' => 'Seminativo'
        ]);
        Plantcategory::create([
            'id' => 4,
            'name' => 'Piante officinali'
        ]);
        Plantcategory::create([
            'id' => 5,
            'name' => 'Coltivazioni di avvicendamento'
        ]);

        Productcategory::create([
            'id' => 1,
            'name' => 'Farine'
        ]);
        Productcategory::create([
            'id' => 2,
            'name' => 'Vini e distillati'
        ]);
        Productcategory::create([
            'id' => 3,
            'name' => 'Marmellate, salse e confetture'
        ]);
        Productcategory::create([
            'id' => 4,
            'name' => 'Formaggi'
        ]);
        Productcategory::create([
            'id' => 5,
            'name' => 'Olio'
        ]);
        Productcategory::create([
            'id' => 6,
            'name' => 'Carne'
        ]);
        Productcategory::create([
            'id' => 7,
            'name' => 'Uova'
        ]);
        Productcategory::create([
            'id' => 8,
            'name' => 'Cosmetica e detergenti'
        ]);

        foreach ($records as $key => $record) {
            Plant::create([
                'id' => $record['id'],
                'abbreviazione' => $record['abbreviazione'],
                'nome' => $record['nome'],
                'plantcategories_id' => $record['plantcategories_id'],
                'sulla_fila'=> $record['sulla_fila'],	
                'tra_file' => $record['tra_file'],	
                'trapianto'=> json_encode($record['trapianto']),	
                'semina' => json_encode($record['semina']),
                'semina_out'=> json_encode($record['semina_out']),	
                'raccolta' => json_encode($record['raccolta']),
                'gg_campo' => json_encode($record['gg_campo']),
                'consumatore' => $record['consumatore'],
                'stagione' => $record['stagione'],
                'trattamenti_consigliati' => $record['trattamenti_consigliati'],
                'richieste_nutrizionali' => $record['richieste_nutrizionali'],
                'image' => $record['image'],
                'icon' => $record['icon'],
                'color' => $record['color'],
                'border_color' => $record['border_color']
            ]);
        }
    }
    public function import_CSV($filename, $delimiter = ','){
        if(!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false){
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false){
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
        return $data;
    }
}
