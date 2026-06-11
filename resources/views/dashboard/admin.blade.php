@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Visão geral</p>
            <h1 class="h3 mb-0">Painel do administrador</h1>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @foreach ($stats as $label => $value)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="small text-uppercase text-muted fw-semibold mb-2">{{ ucfirst($label) }}</div>
                        <div class="display-6 fw-bold">{{ $value }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="h5 mb-3">Resumo da área administrativa</h2>
            <p class="mb-0">
                Use este painel para administrar disciplinas, séries, atividades e acompanhar o andamento das aulas e revisões.
            </p>
        </div>
    </div>
@endsection
