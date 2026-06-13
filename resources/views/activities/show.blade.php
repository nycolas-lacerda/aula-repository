@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
            <h1 class="h3 mb-1">{{ $activity->title }}</h1>
            <p class="text-muted mb-0">{{ $activity->subject?->name }} - {{ $activity->grade?->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><span class="badge text-bg-secondary">{{ $activity->statusLabel() }}</span></dd>

                <dt class="col-sm-3">Criada por</dt>
                <dd class="col-sm-9">{{ $activity->creator?->name }}</dd>

                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9">{{ $activity->description }}</dd>
            </dl>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Conteúdo</div>
                <div class="card-body">
                    {!! nl2br(e($activity->content)) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Arquivos</div>
                <div class="card-body">
                    @forelse ($activity->files as $file)
                        <div class="card border mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <div class="fw-semibold">{{ $file->file_name }}</div>
                                        <div class="text-muted small">{{ $file->mime_type ?: 'Arquivo anexado' }}</div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#previewModal{{ $file->id }}">
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
                                                @if ($file->isImage())
                                                    <img src="{{ $file->publicUrl() }}" class="img-fluid">
                                                @else
                                                    <div class="alert alert-info">
                                                        Pré-visualização indisponível.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="mb-0">Nenhum arquivo anexado.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Aulas relacionadas</div>
                <div class="card-body">
                    @forelse ($activity->lessons as $lesson)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="fw-semibold">{{ $lesson->title }}</div>
                            <div class="text-muted small">{{ $lesson->teacher?->name }} - {{ $lesson->statusLabel() }}
                            </div>
                        </div>
                    @empty
                        <p class="mb-0">Nenhuma aula relacionada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
