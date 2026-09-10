<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Definizione dei campi che possono essere assegnati in massa (mass assignment)
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Con questo comando la password viene automaticamente hashata quando viene salvata nel database
        ];
    }

    // Ogni utente può avere più task associati, quindi si definisce la relazione "hasMany" con il modello Task.
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}