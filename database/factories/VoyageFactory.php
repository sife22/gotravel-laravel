<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voyage>
 */
class VoyageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre'=> $this->faker->name(),
            'type'=> 'Client',
            'desc'=> 'Voyage organisé',
            'description'=> '{"1":"Le depart", "2":"Le retour"}',
            'prix'=> $this->faker->numberBetween(2000, 100000),
            'categorie'=> "À l'étranger",
            'pays'=> 'USA',
            'ville'=> $this->faker->word(),
            'nombre_vues'=> $this->faker->numberBetween(10, 1000),
            'date_expiration'=> '2024-01-01',
            'date_depart'=> '2024-02-01',
            'date_retour'=> '2024-03-01',
            'date_ajoute'=> '2023-12-01',
            'agence_id'=> '1',
        ];
    }
}
