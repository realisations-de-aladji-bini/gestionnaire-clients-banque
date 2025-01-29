<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompteSeeder extends Seeder
{
    /**
     * On insère 30 éléments dans la table "comptes".
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Compte::factory(30)->create();
    }
}
