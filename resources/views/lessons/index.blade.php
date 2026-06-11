@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
            <h1 class="h3 mb-0">Aulas</h1>
        </div>
        <a href="{{ route('lessons.create') }}" class="btn btn-primary">Nova aula</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Professor</th>
                            <th>Série</th>
                            <th>Status</th>
                            <th>Atividades</th>
                            <th class="text-end" style="width: 260px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lessons as $lesson)
                            <tr>
                                <td class="fw-semibold">{{ $lesson->title }}</td>
                                <td>{{ $lesson->teacher?->name }}</td>
                                <td>{{ $lesson->grade?->name }}</td>
                                <td><span class="badge text-bg-secondary">{{ $lesson->statusLabel() }}</span></td>
                                <td>{{ $lesson->activities->count() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('lessons.show', $lesson) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja remover esta aula?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Nenhuma aula cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $lessons->links() }}
    </div>
@endsection
