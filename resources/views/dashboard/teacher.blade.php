@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Painel do professor</p>
        <h1 class="h3 mb-0">Resumo das suas publicações</h1>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Suas aulas recentes</div>
                <div class="card-body">
                    @forelse ($lessons as $lesson)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="fw-semibold">{{ $lesson->title }}</div>
                            <div class="text-muted small">{{ $lesson->grade?->name }} - {{ $lesson->statusLabel() }}</div>
                        </div>
                    @empty
                        <p class="mb-0">Você ainda não criou aulas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Suas atividades recentes</div>
                <div class="card-body">
                    @forelse ($activities as $activity)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="fw-semibold">{{ $activity->title }}</div>
                            <div class="text-muted small">{{ $activity->subject?->name }} - {{ $activity->grade?->name }}</div>
                        </div>
                    @empty
                        <p class="mb-0">Você ainda não criou atividades.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
