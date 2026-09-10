<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Se l'utente è autenticato, viene reindirizzato alla lista dei task
    if (auth()->check()) {
        return redirect()->route('tasks.index');
    }

    // Altrimenti viene mostrata la pagina di benvenuto.
    return view('welcome');
})->name('welcome');

// Route per mostrare il form di registrazione dell'utente.
Route::get('/register', [UserController::class, 'showRegisterForm'])
    ->middleware('guest') // Il middleware 'guest' assicura che solo gli utenti non autenticati possano accedere a questa route
    ->name('register'); // name() è utile affinché nel codice si possa fare riferimento alla route con route('register')

// Route per la registrazione di un nuovo utente.
Route::post('/register', [UserController::class, 'register'])
    ->middleware('guest');

// Route per mostrare il form di login dell'utente.
Route::get('/login', [UserController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

// Route per il login di un utente esistente.
Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest');

// Route per il logout dell'utente autenticato, per cui è protetta dal middleware 'auth'.
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
    Tutte le routes per la gestione dei task richiedono che l'utente sia autenticato.
    Questo comando genera automaticamente le seguenti routes per il controller TaskController:
    - GET /tasks -> index() : per ottenere la lista di tutti i task
    - GET /tasks/create -> create() : per mostrare il form di creazione di un nuovo task
    - POST /tasks -> store() : per creare un nuovo task
    - GET /tasks/{task}/edit -> edit() : per mostrare il form di modifica di un task specifico
    - PUT/PATCH /tasks/{task} -> update() : per aggiornare un task esistente
    - DELETE /tasks/{task} -> destroy() : per eliminare un task esistente
*/
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class) // il metodo resource() genera automaticamente tutte le rotte CRUD (Create, Read, Update, Delete).
        ->except(['show']); // Escludo la route show (GET /tasks/{task}) perché non è necessaria in questa applicazione.
});