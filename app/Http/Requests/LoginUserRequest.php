<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Gli utenti non autenticati possono inviare richieste di login
    }

    public function rules(): array
    {
        // Regole di validazione per la richiesta di login dell'utente.
        return [
            'email' => ['required', 'string', 'email'],
            // In questo caso non devo fare la validazione dell'input per l'inserimento nel database, ma la sola verifica delle credenziali, quindi qui non è necessario verificare il formato della password.
            'password' => ['required', 'string'],
        ];
    }
}
