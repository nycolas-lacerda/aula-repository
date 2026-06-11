@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Cadastro base</p>
            <h1 class="h3 mb-0">Séries</h1>
        </div>
        <a href="{{ route('grades.create') }}" class="btn btn-primary">Nova série</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="text-end" style="width: 180px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                            <tr>
                                <td>{{ $grade->id }}</td>
                                <td class="fw-semibold">{{ $grade->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja remover esta série?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">Nenhuma série cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $grades->links() }}
    </div>
@endsection
