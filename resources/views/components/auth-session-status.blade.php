@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success']) }}>
        @php
            $message = match ($status) {
                'profile-updated' => 'Perfil atualizado com sucesso.',
                'password-updated' => 'Senha atualizada com sucesso.',
                'verification-link-sent' => 'Um novo link de verificação foi enviado.',
                'password-reset-link-sent' => 'Um link para redefinição de senha foi enviado.',
                default => __($status),
            };
        @endphp

        {{ $message }}
    </div>
@endif
