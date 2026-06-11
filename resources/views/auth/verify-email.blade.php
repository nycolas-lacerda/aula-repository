<x-guest-layout>
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Validação de e-mail</p>
        <h2 class="h3 mb-2">Confirme seu e-mail</h2>
        <p class="text-muted mb-0">Antes de começar, confirme seu e-mail clicando no link enviado.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Um novo link de verificação foi enviado para o e-mail informado no cadastro.
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>Reenviar e-mail de verificação</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link px-0 text-decoration-none">Sair</button>
        </form>
    </div>
</x-guest-layout>
