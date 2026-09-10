<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    /* 
        Fornisce metodi per autorizzare le azioni dell'utente.
        Questo viene chiamato "trait" in PHP, e permette di includere metodi da una classe in un'altra senza usare l'ereditarietà.
        Fare ciò è utile per ottenere ereditarietà multipla, non è supportata direttamente in PHP.
    */
    use AuthorizesRequests;
}
