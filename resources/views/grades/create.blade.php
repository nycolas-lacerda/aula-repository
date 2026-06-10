@extends('layouts.app')

@section('content')
    <h1>Nova Série</h1>
    <form action="{{ route('grades.store') }}" method="POST">
        @csrf
        <x-form.input name="name" label="Nome da Série" />
        <button type="submit" class="btn btn-success">
            Salvar
        </button>

        <a href="{{ route('grades.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
