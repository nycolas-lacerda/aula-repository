<x-guest-layout>
    <div class="mb-4">
        <p class="text-uppercase text-muted small fw-semibold mb-1">Acesso restrito</p>
        <h2 class="h3 mb-2">Entrar no sistema</h2>
        <p class="text-muted mb-0">Use seu e-mail e senha para acessar as funcionalidades do projeto.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Lembrar-me</label>
            </div>

            @if (Route::has('password.request'))
                <a class="link-primary text-decoration-none" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif
        </div>

        <div class="col-12 d-grid">
            <x-primary-button>Entrar</x-primary-button>
        </div>
        @if (Route::has('register'))
            <div class="col-12 text-center">
                <span class="text-muted">Não possui uma conta?</span>
                <a href="{{ route('register') }}" class="link-primary text-decoration-none fw-semibold">
                    Cadastre-se
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
