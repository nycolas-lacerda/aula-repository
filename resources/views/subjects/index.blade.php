@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h1>Disciplinas</h1>

    <a
        href="{{ route('subjects.create') }}"
        class="btn btn-primary">

        Nova Disciplina

    </a>

</div>

<table class="table table-bordered">

    <thead>

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

    </thead>

    <tbody>

    @foreach($subjects as $subject)

        <tr>

            <td>
                {{ $subject->id }}
            </td>

            <td>
                {{ $subject->name }}
            </td>

            <td>

                <a
                    href="{{ route('subjects.edit',$subject) }}"
                    class="btn btn-warning btn-sm">

                    Editar

                </a>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

{{ $subjects->links() }}

@endsection