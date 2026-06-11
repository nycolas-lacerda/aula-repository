<section>
    <header class="mb-4">
        <h2 class="h5 mb-2">Informações do perfil</h2>
        <p class="text-muted mb-0">Atualize as informações do seu perfil e o endereço de e-mail.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="row g-3">
        @csrf
        @method('patch')

        <div class="col-12">
            <x-input-label for="name" value="Nome" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="col-12">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <div class="alert alert-warning">
                        Seu e-mail ainda não foi verificado.
                        <button form="send-verification" class="btn btn-link p-0 align-baseline text-decoration-none">
                            Clique aqui para reenviar o e-mail de verificação.
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success">
                            Um novo link de verificação foi enviado para seu e-mail.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-12 d-flex align-items-center gap-3">
            <x-primary-button>Salvar</x-primary-button>

            @if (session('status') === 'profile-updated')
                <span class="text-muted">Salvo.</span>
            @endif
        </div>
    </form>
</section>
