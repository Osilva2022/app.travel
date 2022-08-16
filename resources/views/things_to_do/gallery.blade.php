@php
$gallery = $_GET['gallery'];
@endphp
@foreach ($gallery as $img)
    <div class="row">
        <div class="col">
            <img src="{{ images($img) }}" class="card-img-slider">
        </div>
    </div>
@endforeach
