<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    // Questo metodo determina se l'utente è autorizzato a effettuare questa richiesta.
    public function authorize(): bool
    {
        // L'utente ha il permesso di aggiornare il task specifico che sta cercando di modificare.
        return $this->user()->can('update', $this->route('task'));
    }

    // Questo metodo restituisce le regole di validazione che si applicano alla richiesta di aggiornamento di un task.
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:todo,in_progress,completed'],
        ];
    }
}
