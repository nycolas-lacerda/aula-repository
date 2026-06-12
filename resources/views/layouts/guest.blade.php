<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'Aula') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center py-5">
        <div class="container">
            <div class="row g-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <div class="col-lg-6 d-flex flex-column justify-content-between p-5 text-white"
                    style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 50%, #06b6d4 100%);">
                    <div>
                        <span class="badge text-bg-light text-primary-emphasis fw-semibold mb-3">Sistema
                            pedagógico</span>
                        <h1 class="display-6 fw-bold mb-3"><a href="{{ route('login') }}">{{ config('app.name', 'Aula') }}</a></h1>
                        <p class="lead mb-0">
                            Gestão de aulas, atividades, revisões e perfis em uma interface clara, organizada e pronta
                            para apresentação.
                        </p>
                    </div>

                    <div class="row g-3 mt-4">
                        <div class="col-12 col-md-4">
                            <div class="card bg-white bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <p class="small text-uppercase fw-semibold mb-2">Perfis</p>
                                    <p class="mb-0">Administrador, coordenador e professor com acesso definido.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-white bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <p class="small text-uppercase fw-semibold mb-2">Fluxo</p>
                                    <p class="mb-0">Rascunho, submissão, aprovação e comentários.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-white bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <p class="small text-uppercase fw-semibold mb-2">Interface</p>
                                    <p class="mb-0">Visual limpo com cards e formulários padronizados.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-4 p-md-5 bg-body-tertiary">
                    <div class="d-flex justify-content-center mb-4 d-lg-none">
                        <div class="text-center">
                            <div class="badge text-bg-primary mb-2">Acesso ao sistema</div>
                            <h2 class="h3 mb-0">Entre na plataforma</h2>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
