<section class="space-y-6">
    <header class="mb-4">
        <h2 class="h5 mb-2">Excluir conta</h2>
        <p class="text-muted mb-0">
            Ao excluir sua conta, todos os recursos e dados serão removidos permanentemente. Faça o download do que quiser manter antes de continuar.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Excluir conta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="h5 mb-3">
                Tem certeza de que deseja excluir sua conta?
            </h2>

            <p class="text-muted">
                Depois que a conta for excluída, todos os recursos e dados serão apagados permanentemente. Informe sua senha para confirmar.
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="Senha" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Senha"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Excluir conta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
