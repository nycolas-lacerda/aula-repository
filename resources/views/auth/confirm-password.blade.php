<x-guest-layout>
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Área segura</p>
        <h2 class="h3 mb-2">Confirme sua senha</h2>
        <p class="text-muted mb-0">Esta é uma área segura da aplicação. Confirme sua senha antes de continuar.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="col-12 d-grid">
            <x-primary-button>Confirmar</x-primary-button>
        </div>
    </form>
</x-guest-layout>
