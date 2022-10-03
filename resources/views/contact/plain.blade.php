{!! $new_contact->subject !!}

Nombre: {{ $new_contact->firstname }}
Apellido:{{ $new_contact->lastname }}
Correo:{{ $new_contact->email }}
Codigo Postal:{{ $new_contact->zipcode }}
Mensaje:
    {{ $new_contact->message }}