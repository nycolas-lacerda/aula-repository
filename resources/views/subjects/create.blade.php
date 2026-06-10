@extends('layouts.app')

@section('content')
    <h1>Nova Disciplina</h1>

    <form action="{{ route('subjects.store') }}" method="POST">

        @csrf

        <x-form.input name="name" label="Nome" />

        <div class="mb-3">

            <label class="form-label">
                Descrição
            </label>

            <textarea name="description" class="form-control"></textarea>

        </div>

        <button class="btn btn-success">

            Salvar

        </button>

    </form>
@endsection
