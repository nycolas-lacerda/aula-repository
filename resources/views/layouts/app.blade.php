<!DOCTYPE html>
<html>

<head>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

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

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>