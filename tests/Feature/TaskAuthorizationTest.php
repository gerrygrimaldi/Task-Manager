<?php

// Test PHPUnit per verificare l'autorizzazione delle operazioni sui task. Controlla che gli utenti non autorizzati non possano visualizzare, modificare o eliminare i task di altri utenti.

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; // Questa è la classe base dei test in Laravel, basata su PHPUnit.
use App\Models\Task;
use App\Models\User;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_view_unauthorized_task_edit_page(): void
    {
        $task = Task::factory()->create(); // Creiamo un task fittizio associato a un nuovo utente fittizio
        $unknownUser = User::factory()->create(); // Creiamo un secondo utente fittizio che non è proprietario del task

        $this->actingAs($unknownUser); // Ora ci identifichiamo come il secondo utente fittizio

        // route() chiama il metodo route() in web.php che fa riferimento al metodo edit di TaskController e infine mostrare la pagina di modifica del task
        $response = $this->get(route('tasks.edit', $task)); // Proviamo ad accedere alla pagina di modifica del task creato dal primo utente

        // Il risultato atteso è true, cioè la visualizzazione della pagina di modifica del task deve essere impedita
        $response->assertForbidden();
    }

    public function test_cannot_update_unauthorized_task(): void
    {
        $task = Task::factory()->create(); // Creiamo un task fittizio
        $unknownUser = User::factory()->create(); // Creiamo un secondo utente fittizio

        // Memorizzo i valori originali del task
        $originalTitle = $task->title;
        $originalDescription = $task->description;
        $originalDueDate = $task->due_date;
        $originalPriority = $task->priority;
        $originalStatus = $task->status;

        $this->actingAs($unknownUser); // Ora ci identifichiamo come il secondo utente fittizio

        // Proviamo a modificare tutto dal task creato dal primo utente inviando una richiesta PUT che punta al metodo update di TaskController
        $response = $this->put(route('tasks.update', $task), [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'due_date' => fake()->dateTimeBetween('today', '+30 days')->format('Y-m-d'),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => fake()->randomElement(['todo', 'in_progress', 'completed']),
        ]);

        // Il risultato atteso è true, cioè la modifica del task deve essere impedita
        $response->assertForbidden();

        // Deve restituire true perché il task non deve essere modificato nel database
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $originalTitle,
            'description' => $originalDescription,
            'due_date' => $originalDueDate,
            'priority' => $originalPriority,
            'status' => $originalStatus,
        ]);
    }

    public function test_cannot_delete_unauthorized_task(): void
    {
        $task = Task::factory()->create(); // Task fittizio
        $unknownUser = User::factory()->create(); // Secondo utente fittizio

        $this->actingAs($unknownUser); // Questo utente proverà a eseguire l'azione

        // L'utente non autorizzato prova a eliminare il task creato dal primo utente
        $response = $this->delete(route('tasks.destroy', $task));

        // Il risultato atteso è true, cioè la modifica del task deve essere impedita.
        $response->assertForbidden();

        // Deve restituire true perché il task non deve essere eliminato dal database.
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id, // Corrisponde alla query "SELECT * FROM tasks WHERE id = $task->id"
        ]);
    }
}
