@component('mail::message')
# Ciao!

Il tuo ordine è stato correttamente registrato nei nostri Database ed è in preparazione! <br>
Buon appetito!
@component('mail::button', ['url' => '/'])
Torna al sito
@endcomponent

Grazie,<br>
Deliveboo
@endcomponent
