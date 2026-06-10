<!DOCTYPE html>
<html>

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>
        Sistema Pedagógico
    </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand">
                Sistema Pedagógico
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                <div class="list-group rounded-0 vh-100">
                    <a href="{{ route('subjects.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        Disciplinas
                    </a>

                    <a href="{{ route('grades.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->routeIs('grades.*') ? 'active' : '' }}">
                        Séries
                    </a>
                </div>
            </div>

            <div class="col-md-10 p-4">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
