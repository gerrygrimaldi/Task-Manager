<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// La migrazione serve per creare le tabelle nel database, in questo caso la tabella "tasks" che conterrà le attività degli utenti
return new class extends Migration
{
    // Se la migrazione viene eseguita, il metodo "up" viene chiamato per creare la tabella "tasks" con le colonne specificate
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            /*
                Il comando seguente corrisponde automaticamente a:
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();
                Questo è possibile grazie al metodo constrained().
                Inoltre, il metodo "cascadeOnDelete()" indica che se un
                utente viene eliminato, tutte le attività associate a
                quell'utente in tasks verranno eliminate automaticamente.
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->enum('status', ['todo', 'in_progress', 'completed']);

            $table->timestamps();
        });
    }

    // Se la migrazione viene annullata, il metodo "down" viene chiamato per eliminare la tabella "tasks" dal database
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
