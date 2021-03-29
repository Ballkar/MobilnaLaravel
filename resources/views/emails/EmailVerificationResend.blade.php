@component('mail::message')
# Witaj {{ $user->name }},

Prosimy o potwierdzenie adresu e-mail za pomocą przycisku poniżej!

Gdy już to zrobisz możesz zalogować się na swoje konto za pomocą adresu email: {{$user->email}}
oraz hasła podanego podczas zakładania konta.

Jeśli nie pamiętasz hasła, można ustawić nowe korzystając z funkcji przypomnienia hasła.

@component('mail::button', ['url'=> $urlToVerify])
    Potwierdź adres email
@endcomponent

@endcomponent
