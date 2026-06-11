<x-guest-layout>
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Recuperação de acesso</p>
        <h2 class="h3 mb-2">Esqueceu sua senha?</h2>
        <p class="text-muted mb-0">Informe seu e-mail e enviaremos um link para redefinir a senha.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="col-12 d-grid">
            <x-primary-button>Enviar link de redefinição</x-primary-button>
        </div>
    </form>
</x-guest-layout>
