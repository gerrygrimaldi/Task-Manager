<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route per mostrare il form di registrazione dell'utente.
Route::get('/register', [UserController::class, 'showRegisterForm'])
    ->name('register');

// Route per la registrazione di un nuovo utente.
Route::post('/register', [UserController::class, 'register']);

// Route per mostrare il form di login dell'utente.
Route::get('/login', [UserController::class, 'showLoginForm'])
    ->name('login');

// Route per il login di un utente esistente.
Route::post('/login', [UserController::class, 'login']);

// Route per il logout dell'utente autenticato, per cui è protetta dal middleware 'auth'.
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
    Tutte le routes per la gestione dei task richiedono che l'utente sia autenticato.
    Questo comando genera automaticamente le seguenti routes per il controller TaskController:
    - GET /tasks -> index() : per ottenere la lista di tutti i task
    - POST /tasks -> store() : per creare un nuovo task
    - GET /tasks/{task}/edit -> edit() : per mostrare il form di modifica di un task specifico
    - PUT/PATCH /tasks/{task} -> update() : per aggiornare un task esistente
    - DELETE /tasks/{task} -> destroy() : per eliminare un task esistente
*/
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class) // il metodo resource() genera automaticamente tutte le rotte CRUD (Create, Read, Update, Delete).
        ->except(['show']); // Escludiamo la route 'show' perché non vogliamo mostrare i dettagli di un task specifico.
});