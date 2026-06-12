<x-guest-layout>
    <div class="mb-4">
        <h2 class="h3 mb-2">Registrar novo usuário</h2>
        <p class="text-muted mb-0">Escolha o perfil adequado para liberar as permissões corretas dentro do sistema.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <x-input-label for="name" value="Nome" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="col-12">
            <x-input-label for="role" value="Perfil" />
            <select id="role" name="role" class="form-select" required>
                <option value="">Selecione</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected(old('role', 'teacher') === $role->name)>
                        {{ \App\Models\User::roleDisplayName($role->name) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
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

        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <a class="link-primary text-decoration-none" href="{{ route('login') }}">
                Já tem cadastro?
            </a>

            <x-primary-button>Registrar</x-primary-button>
        </div>
    </form>
</x-guest-layout>
