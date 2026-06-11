<section>
    <header class="mb-4">
        <h2 class="h5 mb-2">Atualizar senha</h2>
        <p class="text-muted mb-0">Use uma senha longa e aleatória para manter sua conta segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="row g-3">
        @csrf
        @method('put')

        <div class="col-12">
            <x-input-label for="update_password_current_password" value="Senha atual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="update_password_password" value="Nova senha" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="update_password_password_confirmation" value="Confirmar senha" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="col-12 d-flex align-items-center gap-3">
            <x-primary-button>Salvar</x-primary-button>

            @if (session('status') === 'password-updated')
                <span class="text-muted">Salvo.</span>
            @endif
        </div>
    </form>
</section>
