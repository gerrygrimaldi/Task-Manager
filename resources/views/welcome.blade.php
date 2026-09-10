@extends('app')

@section('title', 'Task Manager')

@section('content')

    <div class="row justify-content-center">
        {{-- La card inserita in questo container, su schermi grandi, prenderà più spazio rispetto alle altre pagine --}}
        <div class="col-lg-8">

            <div class="card shadow-sm text-center">
                <div class="card-body p-5">

                    <h1 class="display-5 fw-bold mb-3">Task Manager</h1>

                    {{-- con "lead" il testo è più grande e in grassetto --}}
                    <p class="lead text-secondary mb-4">Gestisci le tue attività in modo semplice e organizzato.</p>

                    <div class="d-flex justify-content-between gap-2">

                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Accedi</a>

                        <a href="{{ route('register') }}" class="btn btn-primary">Registrati</a>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection