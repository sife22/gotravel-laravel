<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=> $this->faker->name(),
            'prenom'=> $this->faker->name(),
            'tel'=> $this->faker->phoneNumber(),
            'date_inscription'=> $this->faker->date(),
            'email'=> $this->faker->email(),
            'mot_de_passe'=> Hash::make($this->faker->password(2, 10))
        ];
    }
}
