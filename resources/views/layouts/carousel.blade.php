<!-- SLIDER -->
<div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-interval="false">

    <div class="carousel-inner">
        <div class="carousel-item active">
            <picture>
                <source srcset="{{ asset('img/president-day-tribune-travel.png') }}" media="(min-width: 435px)" />
                <img src="{{ asset('img/movil-president-day-tribune-travel.png') }}" alt="President Day" class="img-slider-home" width="100%" height="100%"/>
            </picture>
        </div>
        @foreach ($destinations as $dd)
            @php
                $active = '';
                $b = true;
                if ($dd->slug == 'puerto-vallarta') {
                    $b = false;
                    $active = 'active';
                }
            @endphp

            {{-- <div class="carousel-item {{ $active }}"> --}}
            <div class="carousel-item">
                <div class="opacity-effect"></div>
                <img {!! img_meta($dd->image_data, $dd->image_alt, $b) !!} class="img-slider-home" width="100%" height="100%" aria-hidden="true"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1 id="t1" class="text-white">{!! $dd->name !!}</h1>
                        <p class="text-white">{!! $dd->description !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        {{--  --}}
    </div>
</div>
<!-- SLIDER -->
