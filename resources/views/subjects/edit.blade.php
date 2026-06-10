@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">

            <h1>Editar Disciplina</h1>

            <form action="{{ route('subjects.update', $subject) }}" method="POST">

                @csrf
                @method('PUT')

                <x-form.input name="name" label="Nome" :value="$subject->name" />

                <div class="mb-3">

                    <label class="form-label">
                        Descrição
                    </label>

                    <textarea name="description" class="form-control" rows="5">{{ old('description', $subject->description) }}</textarea>

                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success">

                    Salvar Alterações

                </button>

                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>
    </div>
@endsection
