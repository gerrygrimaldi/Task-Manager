<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        // Mostra il form di registrazione dell'utente.
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        // Nella creazione, la password non viene salvata in chiaro, ma viene fatto un hashing mediante casts() di User.php
        $user = User::create($request->validated());
        // Dopo la registrazione, l'utente viene autenticato automaticamente.
        Auth::login($user);
        // Viene creata una nuova sessione per l'utente autenticato.
        $request->session()->regenerate();

        // L'utente viene reindirizzato alla lista dei task.
        return redirect()->route('tasks.index');
    }

    public function showLoginForm()
    {
        // Mostra il form di login dell'utente.
        return view('auth.login');
    }

    public function login(LoginUserRequest $request)
    {
        // Si ottengono le credenziali validate da LoginUserRequest.
        $credentials = $request->validated();

        // Si tenta di autenticare l'utente con le credenziali fornite.
        if (!Auth::attempt($credentials)) {
            // Se le credenziali non sono corrette, si ritorna indietro con un messaggio di errore.
            return back()
                ->withErrors([
                    'email' => 'Le credenziali non sono corrette.',
                ])
                ->onlyInput('email'); // L'email inserita rimane nel form
        }

        // In caso di successo, si crea una nuova sessione per l'utente autenticato.
        $request->session()->regenerate();

        // L'utente viene reindirizzato alla lista dei task.
        return redirect()->intended(route('tasks.index'));
    }

    public function logout(Request $request)
    {
        // Si effettua il logout dell'utente autenticato.
        Auth::logout();

        // Si invalida la sessione corrente e si rigenera il token di sessione.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // L'utente viene reindirizzato alla pagina di login.
        return redirect()->route('login');
    }
}