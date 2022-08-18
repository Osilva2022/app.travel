<!-- SLIDER -->
<div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-interval="false">
    <div class="carousel-indicators">
        <?php $i = 0; ?>
        @foreach ($destinations as $dd)
            <?php
            $active = '';
            $true = '';
            if ($dd->slug == 'puerto-vallarta') {
                $active = 'active';
                $true = 'true';
            }
            ?>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $i }}"
                class="{{ $active }}" aria-current="{{ $true }}"></button>
            <?php $i++; ?>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($destinations as $dd)
            @php
                $active = '';
                if ($dd->slug == 'puerto-vallarta') {
                    $active = 'active';
                }
            @endphp

            <div class="carousel-item {{ $active }}">
                <div class="opacity-effect"></div>
                <img src="{{ images($dd->image) }}" alt="{!! $dd->name !!}" class="img-slider-home" width="100%" height="100%"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1 id="t1" class="text-white">{!! $dd->name !!}</h1>
                        <p class="text-white">{!! $dd->description !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- SLIDER -->
