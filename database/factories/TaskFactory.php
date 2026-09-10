<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

// La factory per il modello Task è responsabile della generazione di dati fittizi da inserire nel database per i task
class TaskFactory extends Factory
{
    // Definisce come le task dovranno essere generate casualmente
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associa il task a un utente generato casualmente
            'title' => fake()->sentence(4), // Titolo casuale composto da 4 parole
            'description' => fake()->paragraph(), // Descrizione casuale composta da un paragrafo
            'due_date' => fake()->dateTimeBetween('today', '+30 days')->format('Y-m-d'), // Data di scadenza casuale entro i prossimi 30 giorni
            'priority' => fake()->randomElement(['low', 'medium', 'high']), // Priorità casuale
            'status' => fake()->randomElement(['todo', 'in_progress', 'completed']), // Stato casuale
        ];
    }
}
