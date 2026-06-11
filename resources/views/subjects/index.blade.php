@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Cadastro base</p>
            <h1 class="h3 mb-0">Disciplinas</h1>
        </div>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Nova disciplina</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th class="text-end" style="width: 180px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td class="fw-semibold">{{ $subject->name }}</td>
                                <td>{{ $subject->description ?: '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Deseja remover esta disciplina?')" class="btn btn-danger btn-sm">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Nenhuma disciplina cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $subjects->links() }}
    </div>
@endsection
