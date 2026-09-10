@extends('app')

@section('title', 'Login')

@section('content')

    {{-- Il modulo di login viene disposto al centro della pagina --}}
    <div class="row justify-content-center">
        {{-- A seconda della larghezza dello schermo, il modulo di login occupa una parte specifica della pagina --}}
        <div class="col-md-6 col-lg-5">

            {{-- Card con ombra, che contiene il modulo di login --}}
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">Accedi</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>

                            {{-- Messaggio in caso di errore dovuto all'errato contenuto del campo --}}
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>

                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Il pulsante di invio, per renderlo evidenziato, ha larghezza piena --}}
                        <button type="submit" class="btn btn-primary w-100">Accedi</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">Non hai ancora un account?
                        <a href="{{ route('register') }}">Registrati</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

@endsection