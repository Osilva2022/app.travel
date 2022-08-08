@extends('layouts.app')
<!-- Metadatos -->

@push('metatags')
    <meta name="description"
        content="Travel news and ideas from the top destinations of Puerto Vallarta, Riviera Nayarit, Cancun, Riviera Maya and Los Cabos at Mexico. Hotels, resturants and more">
    <link rel="canonical" href="https://app.tribune.travel/">
    <meta property="og:title" content="App Tribune Travel | Your gateway to México">
    <meta property="og:description"
        content="Travel news and ideas from the top destinations of Puerto Vallarta, Riviera Nayarit, Cancun, Riviera Maya and Los Cabos at Mexico. Hotels, resturants and more">
    <meta property="og:url" content="https://app.tribune.travel/">
    <meta property="og:image" content="{{ asset('storage/tribuna-de-la-bahia.jpg') }}">
    <meta property="og:image:secure_url" content="{{ asset('img/svg/tribune-travel-color.svg') }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@CpsNoticias">
    <meta name="twitter:creator" content="@CpsNoticias">

    <meta name="twitter:title" content="App Tribune Travel | Your gateway to México">
    <meta name="twitter:description"
        content="Travel news and ideas from the top destinations of Puerto Vallarta, Riviera Nayarit, Cancun, Riviera Maya and Los Cabos at Mexico. Hotels, resturants and more">
    <meta name="twitter:image" content="{{ asset('img/svg/tribune-travel-color.svg') }}">

@endpush

<!-- ads -->
@push('ads')
<!-- Tribune Top Leaderboard Home-->
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/21855382314/tt-home-lb-1', [[728, 90], [320, 50]], 'div-gpt-ad-1620235812535-0').addService(googletag.pubads());
    googletag.defineSlot('/21855382314/tt-home-lb-2', [[728, 90], [320, 50]], 'div-gpt-ad-1620235535381-0').addService(googletag.pubads());
    googletag.defineSlot('/21855382314/tt-home-lb-3', [[728, 90], [320, 50]], 'div-gpt-ad-1620236451767-0').addService(googletag.pubads());
    googletag.defineSlot('/21855382314/tt-home-lb-4', [[320, 50], [728, 90]], 'div-gpt-ad-1620236955324-0').addService(googletag.pubads());
    googletag.defineSlot('/21855382314/tt-home-lb-5', [[320, 50], [728, 90]], 'div-gpt-ad-1620239881317-0').addService(googletag.pubads());
    googletag.defineSlot('/21855382314/tt-home-lb-footer', [[728, 90], [320, 50]], 'div-gpt-ad-1620253311869-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>

@endpush

<!-- content -->
@section('content')
    <header>
        @include('menus.menu')
        @include('layouts.carousel')
    </header>
    <main>
        <div class="container" style="max-width: 1024px;">

            <!--ads /21855382314/tt-home-lb-1 -->
            <div id='div-gpt-ad-1620235812535-0' class="text-center" style="margin-top: 10px">
                <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620235812535-0'); });
                </script>
            </div>
            <!-- REVIEWS -->
            <h2 class="my-4">Tribune Reviews</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($review as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {{ $data->destination }}</span>
                                </a>
                                <span class="badge etiqueta-destacado">
                                    <img src="{{ asset('img/estrella.png') }}" alt="{{ $data->title }}" width="30"
                                        height="30">
                                </span>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img src="{{ images($data->image) }}" class="card-img">
                                    <h3 class="card-title-overlay">
                                        {{ $data->title }}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{{ $data->title }}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/y', strtotime($data->post_date)) }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 g-4 d-flex justify-content-between h-100">
                        @foreach ($reviews as $data)
                            @if ($review[0]->id_post != $data->id_post)
                                <div class="col">
                                    <div class="card card-secundario">
                                        <div class="row h-100">
                                            <div class="col card-head-secundario">
                                                <a
                                                    href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                    <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post"
                                                        style="background:{{ $data->destination_color }};">
                                                        {{ $data->destination }}
                                                    </span>
                                                </a>
                                                <a
                                                    href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                    <h3 class="card-title-secundario">{{ $data->title }}</h3>
                                                </a>
                                                <small>
                                                    {{ date('M/d/y', strtotime($data->post_date)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col my-4 d-flex justify-content-center">
                    <a href="{{ route('reviews') }}" class="btn-view-more" type="button">More
                        Reviews</a>
                </div>
                <!-- ads /21855382314/tt-home-lb-2 -->
                <div id='div-gpt-ad-1620235535381-0' class="text-center" style="margin-top: 10px">
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620235535381-0'); });
                    </script>
                </div>
            </div>
            <!-- REVIEWS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- TTD -->
            <div class="row py-4">
                <div class="col-12">
                    <h2 class="text-center mb-4">Things To Do</h2>
                    <div class="" style="overflow-x: auto;">
                        <ul class="nav nav-tabs justify-content-center mb-3" id="myTab" role="tablist"
                            style="min-width: 660px;">
                            @foreach ($destinations as $data)
                                <?php $active = ''; ?>
                                <?php $selected = 'false'; ?>
                                @if ($data->name == 'Puerto Vallarta')
                                    <?php $active = 'active'; ?>
                                    <?php $selected = 'true'; ?>
                                @endif
                                <li class="nav-item nav-test" role="presentation">
                                    <a class="nav-link {{ $active }}" id="{{ $data->term_id }}-tab"
                                        data-bs-toggle="tab" data-bs-target="#tag-{{ $data->term_id }}" type="button"
                                        role="tab" aria-controls="tag-{{ $data->term_id }}"
                                        aria-selected="true">{{ $data->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        @foreach ($destinations as $data)
                            <?php $active = ''; ?>
                            @if ($data->name == 'Puerto Vallarta')
                                <?php $active = 'active show'; ?>
                            @endif
                            <div class="tab-pane fade  {{ $active }}" id="tag-{{ $data->term_id }}"
                                role="tabpanel" aria-labelledby="{{ $data->term_id }}-tab">
                                <div class="row my-3">
                                    <div class="col-12">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="owl-carousel owl-theme ttd-carousel" id="">
                                            <?php $i = 1; ?>
                                            @foreach ($things as $ttd)
                                                @if ($data->slug == $ttd->destination_slug)
                                                    <?php $active = ''; ?>
                                                    @if ($i == 1)
                                                        <?php $active = 'active show'; ?>
                                                    @endif
                                                    <div class="ttd-slider-item">
                                                        <div class="opacity-effect" style="border-radius: 1rem"></div>
                                                        <a
                                                            href="{{ route('things_category', ["$ttd->destination_slug", "$ttd->category_slug"]) }}">
                                                            <img src="{{ images($ttd->image) }}" alt="{{ $ttd->title }}"
                                                                class="carousel-img">
                                                            <div class="container">
                                                                <div class="carousel-info" style="bottom:4px; z-index:2;">
                                                                    <h4>{{ $ttd->title }}</h4>
                                                                    <p style="bottom:4px; color: white;">
                                                                        {{ $ttd->category }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-4 d-flex justify-content-center">
                                            <a href="{{ route('things') }}" class="btn-view-more" type="button">Explore
                                                {{ $data->name }}</a>
                                        </div>
                                        <!-- ads /21855382314/tt-home-lb-3 -->
                                        <div id='div-gpt-ad-1620236451767-0' class="text-center">
                                            <script>
                                            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620236451767-0'); });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- TTD -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- Gallery -->
            <?php if ($gallery): ?>
            <div class="row py-4">
                <div class="col">
                    <h2 class="text-center mb-4">Visit Mexico!</h2>
                    <div class="row g-1">
                        <div class="col-7 col-md-3 position-relative zoom">
                            <a href="{{ $gallery[0]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[0]->media_url }}" class="img-gallery-2" alt="" />
                            </a>
                        </div>
                        <div class="col-5 col-md-6 position-relative zoom">
                            <a href="{{ $gallery[1]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[1]->media_url }}" class="img-gallery" alt="" />
                            </a>
                        </div>
                        <div class="col-5 col-md-3 position-relative zoom">
                            <a href="{{ $gallery[2]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[2]->media_url }}" class="img-gallery" alt="" />
                            </a>
                        </div>
                        <div class="col-7 col-md-3 position-relative zoom">
                            <a href="{{ $gallery[3]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[3]->media_url }}" class="img-gallery-2" alt="" />
                            </a>
                        </div>
                        <div class="col-7 col-md-3 position-relative zoom">
                            <a href="{{ $gallery[4]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[4]->media_url }}" class="img-gallery" alt="" />
                            </a>
                        </div>
                        <div class="col-5 col-md-6 position-relative zoom">
                            <a href="{{ $gallery[5]->permalink }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img src="{{ $gallery[5]->media_url }}" class="img-gallery-2" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col d-flex flex-column align-items-center">
                            <h3>Follow Us!</h3>
                            <div class="">

                                <a class="text-muted" href="{{ config('constants.FACEBOOK_URL') }}">
                                    <img src="{{ asset('img/svg/face-ico.svg') }}" alt="Tribune Travel facebook-icon"
                                        width="24" height="24">
                                </a>
                                <a class="text-muted" href="{{ config('constants.PINTERES_URL') }}" target="_blank">
                                    <img src="{{ asset('img/svg/pint-ico.svg') }}" alt="Tribune Travel pint-icon"
                                        width="24" height="24">
                                </a>
                                <a class="text-muted" href="{{ config('constants.INSTAGRAM_URL') }}">
                                    <img src="{{ asset('img/svg/inst-ico.svg') }}" alt="Tribune Travel insta-icon"
                                        width="24" height="24">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- ads /21855382314/tt-home-lb-5 -->
                    <div id='div-gpt-ad-1620239881317-0' class="col my-4 d-flex justify-content-center">
                        <script>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620239881317-0'); });
                        </script>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- Gallery -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- EVENTS -->
            <div class="row py-4">
                <h2 class="text-center mb-4">Featured Events</h2>
                <div class="owl-carousel owl-theme" id="events-carousel">
                    @foreach ($event as $data)
                        <div class="col-12" style="text-align: -webkit-center;">
                            <div class="row" style="max-width: 420px;">
                                <img src="{{ images($data->image) }}" alt="{{ $data->title }}" class="img-event">
                                <div class="col-3 py-0 h-50">
                                    @php
                                        $date = strtotime($data->start_date);
                                    @endphp
                                    <h2 class="align-middle">{{ date('M', $date) }}</h2>
                                    <h2 class="align-middle"><b>{{ date('d', $date) }}</b></h2>
                                </div>
                                <div class="col-9 py-0 text-start">
                                    <h3>{{ $data->title }}</h3>
                                    <span>{{ $data->destination }}</span><br>
                                    <small>{{ date('M d, Y', $date) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col my-4 d-flex justify-content-center">
                    <a href="{{ route('events') }}" class="btn-view-more" type="button">See the calendar</a>
                </div>
                <!-- ads /21855382314/tt-home-lb-4 -->
                <div id='div-gpt-ad-1620236955324-0' class="text-center">
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620236955324-0'); });
                    </script>
                </div>
            </div>
            <!-- EVENTS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <h2 class="my-4">News</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($new as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {{ $data->destination }}</span>
                                </a>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img src="{{ images($data->image) }}" class="card-img">
                                    <h3 class="card-title-overlay">
                                        {{ $data->title }}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{{ $data->title }}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/y', strtotime($data->post_date)) }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 g-4 h-100">
                        @foreach ($news as $data)
                            @if ($new[0]->id_post != $data->id_post)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row h-100">
                                            <div class="col card-head-secundario">
                                                <a
                                                    href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                    <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post mb-2"
                                                        style="background:{{ $data->destination_color }};">
                                                        {{ $data->destination }}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{{ $data->title }}</h3>
                                                </a>
                                                <small class="text-muted">
                                                    {{ date('M/d/y', strtotime($data->post_date)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col my-4 d-flex justify-content-center">
                    <a href="{{ route('news') }}" class="btn-view-more" type="button">More
                        News</a>
                </div>
                <!--ads /21855382314/tt-home-lb-footer -->
                <div id='div-gpt-ad-1620253311869-0' class="text-center">
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1620253311869-0'); });
                    </script>
                </div>

            </div>
            <!-- NEWS -->
           

    </main>
@endsection
