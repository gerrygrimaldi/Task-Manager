<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Manager')</title>
</head>

<body>

    <nav>
        <div>
            <a href="{{ route('tasks.index') }}">Task Manager</a>

            @auth
                <a href="{{ route('tasks.index') }}">Le mie task</a>
                <a href="{{ route('tasks.create') }}">Nuova task</a>
            @endauth
        </div>

        <div>
            @auth
                <span>{{ auth()->user()->name }}</span>

                <form method="POST"
                      action="{{ route('logout') }}"
                      style="display: inline;">
                    @csrf

                    <button type="submit">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Registrati</a>
            @endauth
        </div>
    </nav>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</body>
</html>