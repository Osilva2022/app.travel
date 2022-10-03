<h2>{!! $new_contact->subject !!}</h2>

<div>
    <p><b>Nombre:</b>&nbsp;{{ $new_contact->firstname }}</p>
    <p><b>Apellido:</b>&nbsp;{{ $new_contact->lastname }}</p>
    <p><b>Correo:</b>&nbsp;{{ $new_contact->email }}</p>
    <p><b>Codigo Postal:</b>&nbsp;{{ $new_contact->zipcode }}</p>
    <p><b>Mensaje:</b></p>
    <p><i>{{ $new_contact->message }}</i></p>
</div>
