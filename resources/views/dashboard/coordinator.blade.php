@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Painel do coordenador</p>
        <h1 class="h3 mb-0">Acompanhamento de revisões</h1>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Aulas pendentes de revisão</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Título</th>
                                    <th>Professor</th>
                                    <th>Série</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submittedLessons as $lesson)
                                    <tr>
                                        <td>{{ $lesson->title }}</td>
                                        <td>{{ $lesson->teacher?->name }}</td>
                                        <td>{{ $lesson->grade?->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">Nenhuma aula aguardando revisão.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Últimas revisões</div>
                <div class="card-body">
                    @forelse ($reviews as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="fw-semibold">{{ $review->lesson?->title }}</div>
                            <div class="text-muted small">{{ $review->reviewer?->name }} - {{ $review->statusLabel() }}</div>
                        </div>
                    @empty
                        <p class="mb-0">Nenhuma revisão registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
