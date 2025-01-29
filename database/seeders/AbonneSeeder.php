<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbonneSeeder extends Seeder
{
    /**
     * On insère 10 éléments dans la table "abonnes".
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Abonne::factory(10)->create();
    }
}
