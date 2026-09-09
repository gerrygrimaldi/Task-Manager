@extends('app')

@section('title', 'Le mie task')

@section('content')

    <h1>Le mie task</h1>

    <a href="{{ route('tasks.create') }}">
        + Nuova task
    </a>

    @if ($tasks->isEmpty())
        <p>Non hai ancora creato nessuna task.</p>
    @else

        <table>
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Scadenza</th>
                    <th>Priorità</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>
                            {{ $task->title }}
                        </td>

                        <td>
                            {{ $task->due_date->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $task->priority }}
                        </td>

                        <td>
                            {{ $task->status }}
                        </td>

                        <td>
                            <a href="{{ route('tasks.edit', $task) }}">
                                Modifica
                            </a>

                            <form
                                method="POST"
                                action="{{ route('tasks.destroy', $task) }}"
                                style="display: inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Sei sicuro di voler eliminare questa task?')"
                                >
                                    Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

@endsection