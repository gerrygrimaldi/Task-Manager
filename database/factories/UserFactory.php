<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

// La factory per il modello User è responsabile della generazione di dati fittizi da inserire nel database per gli utenti
class UserFactory extends Factory
{
    protected static ?string $password; // La password per tutti gli utenti fittizi generati dalla factory sarà per semplicità sempre la stessa

    // Definisce come gli utenti dovranno essere generati casualmente
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Nome casuale generato dalla libreria Faker
            'email' => fake()->unique()->safeEmail(), // Email casuale unica per ogni utente
            'password' => static::$password ??= Hash::make('password'), // Stessa password cifrata, assegnata solo se il valore è nullo
        ];
    }

    public function unverified(): static
    {
        //
    }
}
