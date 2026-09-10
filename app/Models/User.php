<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Definizione dei campi che possono essere assegnati
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Si evita che la password possa essere accidentalmente esposta
    protected $hidden = [
        'password',
    ];

    // Definizione dei campi che possono essere assegnati in massa (mass assignment)
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Con questo comando la password viene automaticamente cifrata quando viene salvata nel database
        ];
    }

    // Ogni utente può avere più task a lui associati, quindi si definisce la relazione "hasMany" con il modello Task.
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
