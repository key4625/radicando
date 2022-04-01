<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Models\Tenant;
/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        Tenant::checkCurrent()
           ? $this->runTenantSpecificSeeders()
           : $this->runLandlordSpecificSeeders();

        Model::reguard();

    }
    public function runTenantSpecificSeeders()
    {
       

        //$sqlPiante = base_path('database/plants.sql');
        //DB::unprepared(file_get_contents($sqlPiante));
        //$this->call(PlantSeeder::class);
        //$this->call(OperationTypeSeeder::class);    
        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(PlantSeeder::class);
        $this->call(OperationTypeSeeder::class);    
    }

    public function runLandlordSpecificSeeders()
    {
        /*$this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(PlantSeeder::class);
        $this->call(OperationTypeSeeder::class);    */
    }
    
}
