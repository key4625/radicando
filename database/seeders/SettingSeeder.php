<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //IMPOSTAZIONI
        DB::table('settings')->insert([ //,
            'name' => "app_company_name",
            'value' => "Nome Azienda",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "app_logo",
            'value' => "tenant/demo/profilo/logo.png",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "app_img_copertina",
            'value' => "tenant/demo/profilo/copertina.jpg",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "app_img",
            'value' => "tenant/demo/profilo/generale.jpg",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "app_descrizione_breve",
            'value' => "Descrzione breve dell'azienda",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "app_descrizione",
            'value' => "Descrzione generale dell'azienda",
            'type' => "Generale"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_coltivazione",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_allevamento",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_seminativo",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_orto",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_frutteto",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "att_officinali",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "gest_raccolto",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "gest_magazzino",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "gest_coltivazioni",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "gest_terreni",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "gest_diario",
            'value' => "on",
            'type' => "Attività"
        ]);
        DB::table('settings')->insert([ //,
            'name' => "view_only_order",
            'value' => "on",
            'type' => "Vista"
        ]);

    }
}
