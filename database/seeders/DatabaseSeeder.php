<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'agustinandrada1@gmail.com',
            'password' => Hash::make('Soporte123@'),
            'role' => "1",
            'name' => "Agustin",
            'last_name' => "Andrada",
            'phone' => "3424286655",
            'user' => "39860201",
        ]);

        User::factory()->create([
            'email' => 'soporte@argdg.com',
            'password' => Hash::make('Soporte123@'),
            'role' => "1",
            'name' => "Soporte",
            'last_name' => "ArgDG",
            'phone' => "1138078298",
            'user' => "12345678",
        ]);

        User::factory(20)->create();

        Owner::factory(20)->create();
    }
}
