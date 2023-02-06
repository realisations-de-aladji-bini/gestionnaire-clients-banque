<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Abonne>
 */
class AbonneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom'=>fake()->lastName(),
            'prenom'=>fake()->firstName(),
            'email'=>fake()->unique()->safeEmail(),
            'contact'=>fake()->phoneNumber(),
            'active'=>fake()->boolean()
        ];
    }
}
