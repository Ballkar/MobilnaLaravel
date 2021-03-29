@component('mail::message')
# Reset hasła w Mobilna Kosmetyczka

Zgłoszono prośbę o zmianę hasła jeżeli jest to pomyłka proszę zignorować wiadomość.
W innym wypadku proszę nacisnąć przycisk poniżej i postępować zgodnie z instrukcjami

@component('mail::button', ['url' => $urlToResend])
Zmiana hasła
@endcomponent

@endcomponent
