@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Gestão de conteúdo</p>
            <h1 class="h3 mb-0">Atividades</h1>
        </div>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">Nova atividade</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Disciplina</th>
                            <th>Série</th>
                            <th>Status</th>
                            <th class="text-end" style="width: 220px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td class="fw-semibold">{{ $activity->title }}</td>
                                <td>{{ $activity->subject?->name }}</td>
                                <td>{{ $activity->grade?->name }}</td>
                                <td><span class="badge text-bg-secondary">{{ $activity->statusLabel() }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('activities.show', $activity) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja remover esta atividade?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Nenhuma atividade cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $activities->links() }}
    </div>
@endsection
