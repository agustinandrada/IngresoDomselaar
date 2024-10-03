<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Authorized>
 */
class AuthorizedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'dni' => fake()->randomNumber(8),
            'lot' => fake()->randomLetter() . fake()->randomNumber(2),
            'email' => fake()->unique()->safeEmail(),
            'vehicle' => fake()->word(),
            'carModel' => fake()->word(),
            'plate' => fake()->word(),
            'photo' => null,
            'color' => fake()->word(),
            'observation' => fake()->word(),
            'owner' => fake()->randomNumber(8),
        ];
    }
}
