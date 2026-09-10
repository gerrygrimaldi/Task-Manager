@extends('app')

@section('title', 'Le mie task')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Le mie task</h1>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary"><span class="fw-bold">+</span> Nuova task</a>
    </div>

    {{-- Se non ci sono ancora task associati all'utente, viene mostrato questo avviso --}}
    @if ($tasks->isEmpty())

        <div class="alert alert-info" role="alert">Non hai ancora creato nessuna task.</div>

    {{-- Altrimenti viene mostrata una tabella che contiene tutti i task a lui associati --}}
    @else

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive"> <!-- La tabella rimane utilizzabile anche su schermi piccoli -->

                    <table class="table table-striped table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">Titolo</th>
                                <th scope="col">Scadenza</th>
                                <th scope="col">Priorità</th>
                                <th scope="col">Stato</th>
                                <th scope="col" class="text-end">Azioni</th>
                            </tr>
                        </thead>

                        <tbody>

                            {{-- Vengono aggiunte tante righe quanti sono i task associati all'utente --}}
                            @foreach ($tasks as $task)

                                <tr>
                                    <td class="fw-semibold">{{ $task->title }}</td>

                                    <td>{{ $task->due_date->format('d/m/Y') }}</td>

                                    <td>
                                        @if ($task->priority === 'low')
                                            <span class="badge text-bg-success">Bassa</span>
                                        @elseif ($task->priority === 'medium')
                                            <span class="badge text-bg-warning">Media</span>
                                        @else
                                            <span class="badge text-bg-danger">Alta</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($task->status === 'todo')
                                            <span class="badge text-bg-secondary">Da fare</span>
                                        @elseif ($task->status === 'in_progress')
                                            <span class="badge text-bg-primary">In corso</span>
                                        @else
                                            <span class="badge text-bg-success">Completata</span>
                                        @endif
                                    </td>

                                    <td class="text-end">

                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Modifica</a>

                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sei sicuro di voler eliminare questa task?')">Elimina</button>
                                        </form>

                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    @endif

@endsection