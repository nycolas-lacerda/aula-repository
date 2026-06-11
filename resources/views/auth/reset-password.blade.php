<x-guest-layout>
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Redefinição de senha</p>
        <h2 class="h3 mb-2">Crie uma nova senha</h2>
        <p class="text-muted mb-0">Preencha os campos abaixo para concluir a redefinição.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="row g-3">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="col-12">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="password_confirmation" value="Confirmar senha" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="col-12 d-grid">
            <x-primary-button>Redefinir senha</x-primary-button>
        </div>
    </form>
</x-guest-layout>
