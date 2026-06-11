@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Fluxo de revisão</p>
        <h1 class="h3 mb-0">Editar revisão</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('reviews.update', $review) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <x-form.select
                        name="lesson_id"
                        label="Aula"
                        :value="$review->lesson_id"
                        :options="$lessons->map(fn ($lesson) => ['value' => $lesson->id, 'label' => $lesson->title . ' - ' . ($lesson->teacher?->name ?? '')])->all()"
                    />
                </div>

                <div class="col-12 col-md-6">
                    <x-form.select name="status" label="Status" :value="$review->status" :options="[
                        ['value' => 'approved', 'label' => 'Aprovada'],
                        ['value' => 'rejected', 'label' => 'Rejeitada'],
                    ]" />
                </div>

                <div class="col-12">
                    <x-form.textarea name="comments" label="Comentários" :value="$review->comments" />
                </div>

                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Salvar alterações</button>
                    <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
