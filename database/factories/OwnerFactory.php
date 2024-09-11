<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OwnerFactory extends Factory
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
            'lot' => fake()->randomNumber(4),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'vehicle' => fake()->word(),
            'carModel' => fake()->word(),
            'plate' => fake()->word(),
            'photo' => null,
            'color' => fake()->word(),
            'observation' => fake()->word(),
        ];
    }
}
