@component('mail::message')

    # O contato {{ $nomeContato }} foi adicionado a sua agenda!

    Acesse sua agenda aqui:


@component('mail::button', ['url' => route('home')])
    Ver agenda
@endcomponent

@endcomponent
