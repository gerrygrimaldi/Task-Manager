<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    // La registrazione non richiede autenticazione, deve poter essere eseguita da tutti.
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Validazione dei dati in ingresso dal form di registrazione
        return [
            'name' => ['required', 'string', 'max:255'],
            // Il campo email non deve essere già presente nella tabella users
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            // La specifica 'confirmed' richiede che ci sia un campo 'password_confirmation' nel form di registrazione con lo stesso valore del campo 'password'
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}