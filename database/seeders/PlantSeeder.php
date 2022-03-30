<?php

namespace Database\Seeders;

use App\Models\Plant;
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
        foreach ($records as $key => $record) {
            Plant::create([
                'id' => $record['id'],
                'abbreviazione' => $record['abbreviazione'],
                'nome' => $record['nome'],
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
