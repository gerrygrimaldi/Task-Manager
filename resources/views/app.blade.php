{{-- Questo file Blade controlla il codice HTML + CSS che dovrà essere mostrato in tutte le pagine della web app. --}}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Manager')</title> {{-- Titolo eventualmente sostituito in base alla route eseguita --}}

    <!-- Bootstrap CSS tramite CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light"> {{-- "bg-light" rende lo sfondo della pagina di colore chiaro --}}

    {{-- navbar con bordo --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">Task Manager</a>

            {{-- I pulsanti sono allineati orizzontalmente ed equidistanti di un certo margine --}}
            <div class="d-flex align-items-center gap-3">

                {{-- Se l'utente è autenticato, compaiono i pulsanti relativi alla gestione dei propri task --}}
                @auth
                    {{-- "text-decoration-none" serve per evitare che il testo del pulsante venga sottolineato --}}
                    <a class="text-decoration-none" href="{{ route('tasks.index') }}">Le mie task</a>

                    <a class="text-decoration-none" href="{{ route('tasks.create') }}">Nuova task</a>

                    <span class="text-secondary">{{ auth()->user()->name }}</span> {{-- Nome dell'utente autenticato --}}

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf

                        {{-- Pulsante mostrato con contorni rossi e grandezza piccola --}}
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>

                @else

                    <a class="text-decoration-none" href="{{ route('login') }}">Accedi</a>

                    {{-- Pulsante evidenziato --}}
                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Registrati</a>

                @endauth

            </div>
        </div>
    </nav>

    {{-- "pb-5" serve per definire un po' di padding in basso, così che il contenuto non arrivi fino bordo della pagina --}}
    <main class="container pb-5">

        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @yield('content') {{-- Contenuto della pagina specifica, che viene definito nei file Blade delle singole route --}}

    </main>

</body>
</html>