<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'Aula') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    @php
        $user = auth()->user();
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid px-3">
            <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Aula') }}
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row g-0 min-vh-100">
            @auth
                <aside class="col-lg-2 col-xl-2 border-end bg-white">
                    <div class="p-3">
                        <div class="dropdown mb-3">
                            <div class="d-flex align-items-center gap-3 dropdown-toggle" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">

                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <div class="text-muted small">
                                        {{ \App\Models\User::roleDisplayName($user->getRoleNames()->first() ?? '') }}
                                    </div>
                                </div>
                            </div>

                            <ul class="dropdown-menu shadow">
                                <li>
                                    <span class="dropdown-item-text">
                                        <strong>{{ $user->name }}</strong>
                                    </span>
                                </li>

                                <li>
                                    <span class="dropdown-item-text text-muted">
                                        {{ $user->email }}
                                    </span>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            Sair
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="list-group list-group-flush rounded-3 shadow-sm">
                            <a href="{{ route('dashboard') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                Painel
                            </a>

                            @if ($user->hasRole('admin', 'coordinator'))
                                <a href="{{ route('subjects.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                                    Disciplinas
                                </a>
                                <a href="{{ route('grades.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('grades.*') ? 'active' : '' }}">
                                    Séries
                                </a>
                            @endif

                            @if ($user->hasAnyRole(['admin', 'coordinator', 'teacher']))
                                <a href="{{ route('activities.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('activities.*') ? 'active' : '' }}">
                                    Atividades
                                </a>
                                <a href="{{ route('lessons.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('lessons.*') ? 'active' : '' }}">
                                    Aulas
                                </a>
                            @endif

                            @if ($user->hasAnyRole(['admin', 'coordinator']))
                                <a href="{{ route('reviews.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('reviews.*') ? 'active' : '' }}">
                                    Revisões
                                </a>
                            @endif
                        </div>
                    </div>
                </aside>
            @endauth

            <main class="{{ auth()->check() ? 'col-lg-10 col-xl-10' : 'col-12' }} p-3 p-lg-4">
                @if (session('success'))
                    <div class="alert alert-success shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
