@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">Fluxo de revisão</p>
            <h1 class="h3 mb-0">Revisões</h1>
        </div>
        <a href="{{ route('reviews.create') }}" class="btn btn-primary">Nova revisão</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Aula</th>
                            <th>Revisor</th>
                            <th>Status</th>
                            <th>Comentários</th>
                            <th class="text-end" style="width: 220px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr>
                                <td>{{ $review->lesson?->title }}</td>
                                <td>{{ $review->reviewer?->name }}</td>
                                <td><span class="badge text-bg-secondary">{{ $review->statusLabel() }}</span></td>
                                <td>{{ $review->comments ?: '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('reviews.show', $review) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja remover esta revisão?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Nenhuma revisão cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $reviews->links() }}
    </div>
@endsection
