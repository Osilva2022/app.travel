{!! $new_contact[1][0]->description !!}

Nombre: {{ $new_contact[0]->firstname }}
Apellido:{{ $new_contact[0]->lastname }}
Correo:{{ $new_contact[0]->email }}
Codigo Postal:{{ $new_contact[0]->zipcode }}
Mensaje:
    {{ $new_contact[0]->message }}