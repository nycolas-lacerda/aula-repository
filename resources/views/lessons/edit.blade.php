@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
            <h1 class="h3 mb-0">Editar aula</h1>
        </div>
        @if ($lesson->status !== 'submitted')
            <form action="{{ route('lessons.submit', $lesson) }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-outline-primary">Submeter para revisão</button>
            </form>
        @endif
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('lessons.update', $lesson) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <x-form.input name="title" label="Título" :value="$lesson->title" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="objective" label="Objetivo" :value="$lesson->objective" />
                </div>
                <div class="col-12">
                    <x-form.select name="grade_id" label="Série" :value="$lesson->grade_id" :options="$grades->map(fn ($grade) => ['value' => $grade->id, 'label' => $grade->name])->all()" />
                </div>
                <div class="col-12">
                    <label class="form-label">Atividades</label>
                    <div class="border rounded p-3 bg-body-tertiary">
                        @php
                            $selectedActivities = old('activities', $lesson->activities->pluck('id')->all());
                        @endphp
                        @forelse ($activities as $activity)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="activities[]"
                                    value="{{ $activity->id }}"
                                    id="activity-{{ $activity->id }}"
                                    @checked(in_array($activity->id, $selectedActivities))
                                >
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
                    <button class="btn btn-success">Salvar alterações</button>
                    <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
