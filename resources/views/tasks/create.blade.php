@extends('app')

@section('title', 'Nuova task')

@section('content')

    <h1>Nuova task</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Titolo</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
            >

            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>

            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>

            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="due_date">Data di scadenza</label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
                required
            >

            @error('due_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="priority">Priorità</label>

            <select id="priority" name="priority" required>
                <option value="">Seleziona una priorità</option>

                <option value="low" @selected(old('priority') === 'low')>
                    Bassa
                </option>

                <option value="medium" @selected(old('priority') === 'medium')>
                    Media
                </option>

                <option value="high" @selected(old('priority') === 'high')>
                    Alta
                </option>
            </select>

            @error('priority')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Stato</label>

            <select id="status" name="status" required>
                <option value="">Seleziona uno stato</option>

                <option value="todo" @selected(old('status') === 'todo')>
                    Da fare
                </option>

                <option value="in_progress" @selected(old('status') === 'in_progress')>
                    In corso
                </option>

                <option value="completed" @selected(old('status') === 'completed')>
                    Completata
                </option>
            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">
            Crea task
        </button>

        <a href="{{ route('tasks.index') }}">
            Annulla
        </a>
    </form>

@endsection