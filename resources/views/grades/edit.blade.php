@extends('layouts.app')

@section('content')
    <h1>Editar Série</h1>
    <form action="{{ route('grades.update', $grade) }}" method="POST">
        @csrf
        @method('PUT')
        <x-form.input name="name" label="Nome da Série" :value="$grade->name" />
        <button type="submit" class="btn btn-success">
            Salvar Alterações
        </button>

        <a href="{{ route('grades.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
