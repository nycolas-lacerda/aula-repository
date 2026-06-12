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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar"
                aria-controls="topNavbar" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="topNavbar">
                <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center gap-3 mt-3 mt-lg-0">
                    @auth
                        <div class="text-white small text-lg-end">
                            <div class="fw-semibold">{{ $user->name }}</div>
                            <div class="opacity-75">
                                {{ \App\Models\User::roleDisplayName($user->getRoleNames()->first() ?? '') }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Sair</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row g-0 min-vh-100">
            @auth
                <aside class="col-lg-2 col-xl-2 border-end bg-white">
                    <div class="p-3">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="small text-uppercase text-muted fw-semibold mb-2">Painel</div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                                <div class="text-muted small">
                                    {{ \App\Models\User::roleDisplayName($user->getRoleNames()->first() ?? '') }}</div>
                            </div>
                        </div>

                        <div class="list-group list-group-flush rounded-3 shadow-sm">
                            <a href="{{ route('dashboard') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                Painel
                            </a>

                            @if ($user->hasRole('admin'))
                                <a href="{{ route('subjects.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                                    Disciplinas
                                </a>
                                <a href="{{ route('grades.index') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('grades.*') ? 'active' : '' }}">
                                    Séries
                                </a>
                            @endif

                            @if ($user->hasAnyRole(['admin', 'teacher']))
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
