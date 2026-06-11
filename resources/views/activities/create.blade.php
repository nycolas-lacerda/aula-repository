@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
        <h1 class="h3 mb-0">Nova atividade</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-12">
                    <x-form.input name="title" label="Título" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="description" label="Descrição" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="content" label="Conteúdo" rows="8" />
                </div>
                <div class="col-md-6">
                    <x-form.select name="subject_id" label="Disciplina" :options="$subjects->map(fn ($subject) => ['value' => $subject->id, 'label' => $subject->name])->all()" />
                </div>
                <div class="col-md-6">
                    <x-form.select name="grade_id" label="Série" :options="$grades->map(fn ($grade) => ['value' => $grade->id, 'label' => $grade->name])->all()" />
                </div>
                <div class="col-12">
                    <x-form.select name="status" label="Status" :options="[
                        ['value' => 'draft', 'label' => 'Rascunho'],
                        ['value' => 'published', 'label' => 'Publicada'],
                        ['value' => 'archived', 'label' => 'Arquivada'],
                    ]" />
                </div>
                <div class="col-12">
                    <label class="form-label" for="files">Arquivos</label>
                    <input id="files" type="file" name="files[]" class="form-control" multiple>
                    @error('files')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Salvar</button>
                    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
