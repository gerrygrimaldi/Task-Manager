@extends('app')

@section('title', 'Registrazione')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">Registrazione</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>

                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>

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

                        <div class="mb-3">
                            {{-- Questo campo viene gestito automaticamente da Laravel durante la validazione, grazie all'attributo "confirmed" utilizzato in RegisterUserRequest --}}
                            <label for="password_confirmation" class="form-label">Conferma password</label>

                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Registrati</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">Hai già un account?
                        <a href="{{ route('login') }}">Accedi</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

@endsection