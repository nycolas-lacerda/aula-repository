@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
        <h1 class="h3 mb-0">Nova aula</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('lessons.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <x-form.input name="title" label="Título" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="objective" label="Objetivo" />
                </div>
                <div class="col-12">
                    <x-form.select name="grade_id" label="Série" :options="$grades->map(fn ($grade) => ['value' => $grade->id, 'label' => $grade->name])->all()" />
                </div>
                <div class="col-12">
                    <label class="form-label">Atividades</label>
                    <div class="border rounded p-3 bg-body-tertiary">
                        @forelse ($activities as $activity)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="activities[]" value="{{ $activity->id }}" id="activity-{{ $activity->id }}">
                                <label class="form-check-label" for="activity-{{ $activity->id }}">
                                    {{ $activity->title }} <span class="text-muted">({{ $activity->subject?->name }} - {{ $activity->grade?->name }})</span>
                                </label>
                            </div>
                        @empty
                            <p class="mb-0">Nenhuma atividade disponível.</p>
                        @endforelse
                    </div>
                    @error('activities')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Salvar rascunho</button>
                    <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
