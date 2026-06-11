@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Fluxo de revisão</p>
            <h1 class="h3 mb-1">Revisão</h1>
            <p class="text-muted mb-0">{{ $review->lesson?->title }}</p>
        </div>
        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Aula</dt>
                <dd class="col-sm-9">{{ $review->lesson?->title }}</dd>

                <dt class="col-sm-3">Professor</dt>
                <dd class="col-sm-9">{{ $review->lesson?->teacher?->name }}</dd>

                <dt class="col-sm-3">Revisor</dt>
                <dd class="col-sm-9">{{ $review->reviewer?->name }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><span class="badge text-bg-secondary">{{ $review->statusLabel() }}</span></dd>

                <dt class="col-sm-3">Comentários</dt>
                <dd class="col-sm-9">{{ $review->comments ?: '-' }}</dd>
            </dl>
        </div>
    </div>

    <div class="row g-4 mt-1">
        @foreach ($review->lesson?->activities ?? [] as $activity)
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">{{ $activity->title }}</span>
                        <span class="badge text-bg-secondary">{{ $activity->statusLabel() }}</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">{{ $activity->description ?: 'Sem descrição.' }}</p>

                        @if ($activity->files->isNotEmpty())
                            <div class="row g-3">
                                @foreach ($activity->files as $file)
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                                    <div>
                                                        <div class="fw-semibold">{{ $file->file_name }}</div>
                                                        <div class="text-muted small">{{ $file->mime_type ?: 'Arquivo anexado' }}</div>
                                                    </div>
                                                    <a href="{{ $file->publicUrl() }}" class="btn btn-sm btn-outline-primary">Abrir</a>
                                                </div>

                                                @if ($file->isImage())
                                                    <img src="{{ $file->publicUrl() }}" alt="{{ $file->file_name }}" class="img-fluid rounded border">
                                                @elseif ($file->isPdf())
                                                    <iframe
                                                        src="{{ $file->publicUrl() }}"
                                                        title="{{ $file->file_name }}"
                                                        class="w-100 border rounded"
                                                        style="min-height: 260px;"
                                                    ></iframe>
                                                @else
                                                    <div class="alert alert-light border mb-0">
                                                        Pré-visualização indisponível para este tipo de arquivo.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mb-0">Esta atividade não possui arquivos anexados.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
