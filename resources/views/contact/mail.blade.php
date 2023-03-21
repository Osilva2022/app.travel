<h2>{!! $new_contact[1][0]->description !!}</h2>

<div>
    <p><b>Nombre:</b>&nbsp;{{ $new_contact[0]->firstname }}</p>
    <p><b>Apellido:</b>&nbsp;{{ $new_contact[0]->lastname }}</p>
    <p><b>Correo:</b>&nbsp;{{ $new_contact[0]->email }}</p>
    <p><b>Codigo Postal:</b>&nbsp;{{ $new_contact[0]->zipcode }}</p>
    <p><b>Mensaje:</b></p>
    <p><i>{{ $new_contact[0]->message }}</i></p>
</div>
