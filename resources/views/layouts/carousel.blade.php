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
                <img src="{{ images($dd->image) }}" alt="{{ $dd->name }}" class="img-slider-home" width="100%" height="100%"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1 id="t1" class="text-white">{{ $dd->name }}</h1>
                        <p class="text-white">{{ $dd->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item">
            <img src="{{ asset('img/slider-v1.jpg') }}" class="bd-placeholder-img-lg" width="100%" height="100%"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Riviera Nayarit</h1>
                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item active">
            <img src="{{ asset('img/slider-v2.jpg') }}" class="bd-placeholder-img-lg" width="100%" height="100%"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Puerto Vallarta</h1>
                    <p>Some representative placeholder content for the second slide of the carousel.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/slider-v3.jpg') }}" class="bd-placeholder-img-lg" width="100%" height="100%"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Los Cabos</h1>
                    <p>Some representative placeholder content for the third slide of this carousel.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> --}}
</div>
<!-- SLIDER -->
