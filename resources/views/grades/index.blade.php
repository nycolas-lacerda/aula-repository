@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h1>Séries</h1>

    <a
        href="{{ route('grades.create') }}"
        class="btn btn-primary">

        Nova Série

    </a>

</div>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th width="180">
                Ações
            </th>
        </tr>
    </thead>

    <tbody>
        @forelse($grades as $grade)
            <tr>
                <td>
                    {{ $grade->id }}
                </td>

                <td>
                    {{ $grade->name }}
                </td>

                <td>
                    <a
                        href="{{ route('grades.edit', $grade) }}"
                        class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form
                        action="{{ route('grades.destroy', $grade) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Deseja remover esta série?')">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    Nenhuma série cadastrada.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $grades->links() }}

@endsection