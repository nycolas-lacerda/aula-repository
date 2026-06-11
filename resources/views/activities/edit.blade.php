@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
        <h1 class="h3 mb-0">Editar atividade</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <x-form.input name="title" label="Título" :value="$activity->title" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="description" label="Descrição" :value="$activity->description" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="content" label="Conteúdo" :value="$activity->content" rows="8" />
                </div>
                <div class="col-md-6">
                    <x-form.select name="subject_id" label="Disciplina" :value="$activity->subject_id" :options="$subjects->map(fn ($subject) => ['value' => $subject->id, 'label' => $subject->name])->all()" />
                </div>
                <div class="col-md-6">
                    <x-form.select name="grade_id" label="Série" :value="$activity->grade_id" :options="$grades->map(fn ($grade) => ['value' => $grade->id, 'label' => $grade->name])->all()" />
                </div>
                <div class="col-12">
                    <x-form.select name="status" label="Status" :value="$activity->status" :options="[
                        ['value' => 'draft', 'label' => 'Rascunho'],
                        ['value' => 'published', 'label' => 'Publicada'],
                        ['value' => 'archived', 'label' => 'Arquivada'],
                    ]" />
                </div>
                <div class="col-12">
                    <label class="form-label" for="files">Adicionar arquivos</label>
                    <input id="files" type="file" name="files[]" class="form-control" multiple>
                </div>
                @if ($activity->files->isNotEmpty())
                    <div class="col-12">
                        <div class="card border-0 bg-body-tertiary">
                            <div class="card-body">
                                <div class="fw-semibold mb-2">Arquivos atuais</div>
                                <ul class="list-group">
                                    @foreach ($activity->files as $file)
                                        <li class="list-group-item">{{ $file->file_name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Salvar alterações</button>
                    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
