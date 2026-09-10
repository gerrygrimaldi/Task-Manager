@extends('app')

@section('title', 'Modifica task')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 mb-4">Modifica task</h1>

                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        {{-- L'attributo method del form supporta solo GET e POST, quindi per il PUT è necessario dichiararlo mediante apposita direttiva di Blade. --}}

                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>

                            {{-- L'attributo value conterrà il valore digitato precedentemente o altrimenti il titolo originale del task --}}
                            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" class="form-control @error('title') is-invalid @enderror" required>

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>

                            <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="due_date" class="form-label">Data di scadenza</label>

                            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" class="form-control @error('due_date') is-invalid @enderror" required>

                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priorità</label>

                            <select id="priority" name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                <option value="">Seleziona una priorità</option>

                                <option value="low" @selected(old('priority', $task->priority) === 'low')>Bassa</option>

                                <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Media</option>

                                <option value="high" @selected(old('priority', $task->priority) === 'high')>Alta</option>
                            </select>

                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Stato</label>

                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Seleziona uno stato</option>

                                <option value="todo" @selected(old('status', $task->status) === 'todo')>Da fare</option>

                                <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>In corso</option>

                                <option value="completed" @selected(old('status', $task->status) === 'completed')>Completata</option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between gap-2">
                            <button type="submit" class="btn btn-primary">Salva modifiche</button>

                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annulla</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection