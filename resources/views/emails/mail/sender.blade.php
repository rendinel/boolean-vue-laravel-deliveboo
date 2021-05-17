@component('mail::message')
# Benvenuto!

E' un piacere averti qua con noi! La registrazione è avvenuta con successo!!!!!!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/admin/restaurants'])
Vai alla tua dashboard!!!!!
@endcomponent

Grazie mille,<br>
Deliveboo
@endcomponent
