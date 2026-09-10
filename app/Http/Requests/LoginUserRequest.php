<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            // Qui non devo fare la validazione dell'input ma la sola verifica delle credenziali, quindi qui i limiti sul formato della password non hanno senso qui.
            'password' => ['required', 'string'],
        ];
    }
}