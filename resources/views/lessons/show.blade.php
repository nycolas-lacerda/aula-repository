@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
            <h1 class="h3 mb-1">{{ $lesson->title }}</h1>
            <p class="text-muted mb-0">{{ $lesson->grade?->name }} - {{ $lesson->statusLabel() }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-warning">Editar</a>
            @if ($lesson->status === 'approved')
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                        Exportar
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('lessons.export.pdf', $lesson) }}">
                                PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('lessons.export.docx', $lesson) }}">
                                DOCX
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Professor</dt>
                <dd class="col-sm-9">{{ $lesson->teacher?->name }}</dd>

                <dt class="col-sm-3">Objetivo</dt>
                <dd class="col-sm-9">{{ $lesson->objective }}</dd>

                <dt class="col-sm-3">Submetida em</dt>
                <dd class="col-sm-9">{{ $lesson->submitted_at?->format('d/m/Y H:i') ?: '-' }}</dd>
            </dl>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Atividades vinculadas</div>
                <div class="card-body">
                    @forelse ($lesson->activities as $activity)
                        <div class="border-bottom pb-3 mb-4">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                <div>
                                    <div class="fw-semibold">{{ $activity->title }}</div>
                                    <div class="text-muted small">Posição {{ $activity->pivot->position }}</div>
                                </div>
                                <span class="badge text-bg-secondary">{{ $activity->statusLabel() }}</span>
                            </div>

                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-header bg-white fw-semibold">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#previewModal">
                                        Visualizar
                                    </button>
                                </div>
                                <div class="modal fade" id="previewModal{{ $file->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ $file->file_name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{ route('lessons.preview.pdf', $lesson) }}"
                                                    class="w-100 border-0" style="height: 900px;">
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="mb-0">Nenhuma atividade vinculada.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Revisões</div>
                <div class="card-body">
                    @forelse ($lesson->reviews as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="fw-semibold">{{ $review->statusLabel() }}</div>
                            <div class="text-muted small">{{ $review->reviewer?->name }} -
                                {{ $review->created_at->format('d/m/Y H:i') }}</div>
                            <p class="mb-0 mt-2">{{ $review->comments ?: 'Sem comentários.' }}</p>
                        </div>
                    @empty
                        <p class="mb-0">Nenhuma revisão registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if ($lesson->status !== 'submitted')
        <div class="mt-4">
            <form action="{{ route('lessons.submit', $lesson) }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-primary">Submeter para revisão</button>
            </form>
        </div>
    @endif
@endsection
