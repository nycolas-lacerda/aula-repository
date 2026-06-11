@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Cadastro base</p>
        <h1 class="h3 mb-0">Nova disciplina</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('subjects.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <x-form.input name="name" label="Nome" />
                </div>
                <div class="col-12">
                    <x-form.textarea name="description" label="Descrição" />
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Salvar</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
