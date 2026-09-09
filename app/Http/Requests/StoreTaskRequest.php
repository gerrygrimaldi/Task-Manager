<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    // Questo metodo determina se l'utente è autorizzato a effettuare questa richiesta.
    public function authorize(): bool
    {
        // $this->user() è un metodo ereditato da Request che restituisce l'utente autenticato che sta effettuando la richiesta.
        return $this->user()->can('create', Task::class);
    }

    // Questo metodo restituisce le regole di validazione che si applicano alla richiesta di creazione di un task.
    public function rules(): array
    {
        // Le regole di validazione specificano i requisiti per ciascun campo del task.
        return [
            'title' => ['required', 'string', 'max:255'], // Stringa non vuota e massimo 255 caratteri.
            'description' => ['nullable', 'string'], // Campo opzionale che può essere nullo o una stringa.
            'due_date' => ['required', 'date', 'after_or_equal:today'], // Data obbligatoria che deve essere odierna o successiva.
            'priority' => ['required', 'in:low,medium,high'], // Campo obbligatorio che deve essere uno dei valori specificati.
            'status' => ['required', 'in:todo,in_progress,completed'], // Campo obbligatorio analogo.
        ];
    }
}
