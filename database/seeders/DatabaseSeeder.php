<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * On insère 10 éléments dans la table "abonnes" et 30 éléments dans "comptes".
     * @return void
     */
    public function run()
    {   
        \App\Models\Abonne::factory(10)->create();
        \App\Models\Compte::factory(30)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
