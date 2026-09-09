<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Questo metodo si occupa di restituire una lista di tutti i task associati all'utente autenticato.
    public function index(Request $request)
    {
        /*
            In particolare, il metodo get() esegue la query per ottenere tutti i task dell'utente autenticato.
            In pratica realizza una query del tipo:
            SELECT * FROM tasks WHERE user_id = ID_UTENTE_AUTENTICATO;
            Il risultato della query viene poi restituito in formato JSON.

            Non è necessaria Form Request specifica perché non ci sono dati da validare.
        */
        $tasks = $request->user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // Questo metodo si occupa di mostrare il form per la creazione di un nuovo task.
    public function create()
    {
        // L'utente deve avere il permesso di creare un nuovo task, quindi viene chiamato il metodo create() di TaskPolicy.
        $this->authorize('create', Task::class);

        return view('tasks.create');
    }

    // Questo metodo si occupa di creare un nuovo task associato all'utente autenticato.
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create(
            // Il metodo validated() restituisce i dati della richiesta che sono stati validati secondo le regole definite in StoreTaskRequest.
            $request->validated()
        );

        // L'utente viene reindirizzato alla lista dei task con un messaggio di conferma.
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task creata con successo.');
    }

    // Questo metodo si occupa di mostrare il form di modifica del task.
    public function edit(Task $task)
    {
        $this->authorize('update', $task); // Viene chiamato il metodo update() di TaskPolicy

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // Questo metodo si occupa di aggiornare lo specifico task richiesto dall'utente autenticato.
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Se la validazione dei dati effettuata da UpdateTaskRequest va a buon fine, il task viene aggiornato con i nuovi dati
        $task->update($request->validated());

        // L'utente viene reindirizzato alla lista dei task con un messaggio di conferma.
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task aggiornata con successo.');
    }

    // Questo metodo si occupa di eliminare lo specifico task richiesto dall'utente autenticato.
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task); // Viene chiamato il metodo delete() di TaskPolicy

        $task->delete();

        // L'utente viene reindirizzato alla lista dei task con un messaggio di conferma.
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task eliminata con successo.');
    }
}
