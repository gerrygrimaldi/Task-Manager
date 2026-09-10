<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    // L'utente può visualizzare tutti i suoi task?
    public function viewAny(User $user): bool
    {
        // Il controller sarà responsabile di filtrare i task in base all'utente autenticato.
        return true;
    }

    // L'utente ha l'autorizzazione per visualizzare il task?
    public function view(User $user, Task $task): bool
    {
        // Solo se l'ID dell'utente corrisponde all'ID dell'utente associato al task.
        return $user->id === $task->user_id;
    }

    // L'utente può creare un nuovo task?
    public function create(User $user): bool
    {
        return true;
    }

    // L'utente può modificare il task?
    public function update(User $user, Task $task): bool
    {
        // Solo se l'ID dell'utente corrisponde all'ID dell'utente associato al task.
        return $user->id === $task->user_id;
    }

    // L'utente può eliminare il task?
    public function delete(User $user, Task $task): bool
    {
        // Solo se l'ID dell'utente corrisponde all'ID dell'utente associato al task.
        return $user->id === $task->user_id;
    }
}
