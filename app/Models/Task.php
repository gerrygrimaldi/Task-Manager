<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory; // Verrà usato nei test automatici per generare dati fittizi per i task

    // Definisce quali attributi possono essere definiti dall'utente quando crea o aggiorna un task
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        // user_id non è incluso per evitare che venga inviato e modificato direttamente dall’utente
    ];

    protected $casts = [
        'due_date' => 'date', // si forza la variabile a un oggetto adeguato a rappresentare la data
    ];

    // Ogni task appartiene a uno e a un solo utente, quindi si definisce la relazione "belongsTo" con il modello User.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
