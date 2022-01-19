<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'email' => 'michele.cappannari@keysoluzioni.it',
            'password' => 'key4Straorto8!',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Simone',
            'email' => 'esseppimultimedia@gmail.com',
            'password' => 'essepi4Radicando!',
            'email_verified_at' => now(),
            'active' => true,
        ]);

     
        $this->enableForeignKeys();
    }
}
