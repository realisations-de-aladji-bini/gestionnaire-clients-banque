<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'abonne_id'=>fake()->randomDigit(),
            'libelle'=>fake()->word(),
            'description'=>fake()->text($maxNbChars = 30),
            'agence'=>fake()->randomDigit(),
            'banque'=>fake()->randomDigit(),
            'numero'=>fake()->randomDigit(),
            'rib'=>fake()->randomDigit(),
            'montant'=>fake()->randomDigit(),
            'domiciliation'=>fake()->address(),
        ];
    }
}
