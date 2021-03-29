@component('mail::message')
# Witaj {{ $user->name }},

Chcemy powitać Cię w systemie Mobilnej Kosmetyczki oraz podziękować za założenie konta.

Prosimy o potwierdzenie adresu e-mail za pomocą przycisku poniżej!

Gdy już to zrobisz możesz zalogować się na swoje konto za pomocą adresu email: {{$user->email}}
oraz hasła podanego podczas zakładania konta.

Jeśli nie pamiętasz hasła, można ustawić nowe korzystając z funkcji przypomnienia hasła.

@component('mail::button', ['url'=> $urlToVerify])
    Potwierdź rejestracje
@endcomponent

@endcomponent
