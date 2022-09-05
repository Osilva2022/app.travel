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
@php
$mostrar = false;
@endphp

@if ($mostrar)
    @push('ads')
        <!-- Tribune Top Leaderboard Home-->
        <script class="slot" defer src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
        <script class="slot" defer>
            window.googletag = window.googletag || {
                cmd: []
            };
            googletag.cmd.push(function() {
                googletag.defineSlot('/21855382314/tt-home-lb-1', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1620235812535-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-home-lb-2', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1620235535381-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-home-lb-3', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1620236451767-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-home-lb-4', [
                    [320, 50],
                    [728, 90]
                ], 'div-gpt-ad-1620236955324-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-home-lb-5', [
                    [320, 50],
                    [728, 90]
                ], 'div-gpt-ad-1620239881317-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-home-lb-footer', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1620253311869-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
    @endpush
@endif
<!-- content -->
@section('content')
    <header>
        @include('menus.menu')
        @include('layouts.carousel')
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col submenu-home py-2">
                    <div class="container" style="max-width: 1024px;">
                        <div class="row g-2">
                            <div class="col-12 col-sm-4 text-white text-center">
                                {{ date('F j, Y') }}
                            </div>
                            <div class="col-auto text-white text-center d-none d-lg-block">
                                <span class="mx-2">
                                    {!! $mxn->country !!} : ${!! $mxn->end_rate !!}
                                </span>
                                @foreach ($divisas_data as $divisa)
                                    <span class="mx-2">
                                        {!! $divisa->country !!} : ${!! $divisa->end_rate !!}
                                    </span>
                                @endforeach
                            </div>
                            <div class="btn-group col text-white text-center d-lg-none d-block">
                                <a class="text-white" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="background-color: #243A85;">
                                    {!! $mxn->country !!} : ${!! $mxn->end_rate !!} <i class="bi bi-caret-down-fill"></i>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #243A85;">
                                    @foreach ($divisas_data as $divisa)
                                        <li>
                                            <a class="dropdown-item text-white" href="#">
                                                {!! $divisa->country !!} : ${!! $divisa->end_rate !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="btn-group col text-white d-flex justify-content-center">
                                <a title="{!! $weather['Vallarta']['text'] !!}" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="background-color: #243A85;">
                                    Vallarta <i class=" {!! $weather['Vallarta']['icon'] !!}"></i>
                                    {!! $weather['Vallarta']['temperature'] !!} <i class="bi bi-caret-down-fill"></i>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #243A85;">
                                    @foreach ($weather as $key => $w)
                                    @if ($key != "Vallarta")
                                    <li>
                                        <a title="{!! $w['text'] !!}" class="dropdown-item text-white" href="#">
                                            {!! $key !!} <i class="{!! $w['icon'] !!}"></i>
                                            {!! $w['temperature'] !!}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="max-width: 1024px;">
            <!--ads /21855382314/tt-home-lb-1 -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620235812535-0' class="col text-center" style="margin-top: 10px">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620235812535-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <!-- TTD -->
            <div class="row py-4">
                <div class="col-12">
                    <h2 class="text-center mb-4">Tribune Guide</h2>
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <div class="owl-carousel owl-theme ttd-carousel" id="">
                                <?php $i = 1; ?>
                                @foreach ($guide as $ttd)
                                    {{-- @if ($data->slug == $ttd->destination_slug) --}}
                                    <?php $active = ''; ?>
                                    @if ($i == 1)
                                        <?php $active = 'active show'; ?>
                                    @endif
                                    <div class="ttd-slider-item">
                                        <a
                                            href="{{ route('guide_category', ["$ttd->destination_slug", "$ttd->category_slug"]) }}?p={!! $ttd->ID !!}">
                                            <div class="opacity-effect" style="border-radius: 1rem"></div>
                                            <img {!! img_meta($ttd->image_data, null, true) !!} class="carousel-img lazy">
                                            <div class="container">
                                                <div class="carousel-info" style="bottom:4px; z-index:2;">
                                                    <h3 class="text-white">{!! $ttd->post_title !!}</h3>
                                                    <p style="bottom:4px; color: white;">
                                                        {!! $ttd->category !!} - {!! $ttd->destination !!}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-4 d-flex justify-content-center">
                            <a href="{{ url('guide') }}?destination=puerto-vallarta" class="btn-view-more"
                                type="button">Show More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TTD -->
            <!-- ads /21855382314/tt-home-lb-2 -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620235535381-0' class="col text-center " style="margin-top: 10px"
                        style='width: 300px; height: 250px;'>
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620235535381-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- REVIEWS -->
            <h2 class="text-center my-4">Tribune Reviews</h2>
            <?php
            //echo img_meta($reviews[0]->image_data);
            ?>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($review as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {!! $data->destination !!}</span>
                                </a>
                                <span class="etiqueta-last-post">
                                    <i class="bi bi-star" style="font-size: 1rem; color:white; margin: 2px;"></i></span>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img {!! img_meta($data->image_data) !!} class="card-img">
                                    <h3 class="card-title-overlay">
                                        {!! $data->title !!}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{!! $data->title !!}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
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
                                                <a href="{{ url("$data->url") }}">
                                                    <img {!! img_meta($data->image_data) !!} class="card-img-secundario lazy">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post"
                                                        style="background:{{ $data->destination_color }};">
                                                        {!! $data->destination !!}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                </a>
                                                <small>
                                                    {{ date('M/d/Y', strtotime($data->post_date)) }}
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
            <div class="row ">
                <div class="col my-4 d-flex justify-content-center">
                    <a href="{{ route('category', ['reviews']) }}" class="btn-view-more" type="button">More
                        Reviews</a>
                </div>
            </div>
            <!-- REVIEWS -->
            <!-- ads /21855382314/tt-home-lb-3 -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620236451767-0' class="col text-center">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620236451767-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
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
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                {{-- <a href="{{ $gallery[0]->permalink }}" target="_blank"> --}}
                                <i class="bi bi-instagram icon-gallery"></i>
                                {{-- <img src="{{ $gallery[0]->media_url }}" width="100" height="100" --}}
                                <img {!! img_meta($gallery[0]->metadata) !!} class="lazy img-gallery-2" loading="lazy">
                            </a>
                        </div>
                        <div class="col-5 col-md-6 position-relative zoom">
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img {!! img_meta($gallery[1]->metadata) !!} class="lazy img-gallery" loading="lazy">
                            </a>
                        </div>
                        <div class="col-5 col-md-3 position-relative zoom">
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img {!! img_meta($gallery[2]->metadata) !!} class="lazy img-gallery" loading="lazy">
                            </a>
                        </div>
                        <div class="col-7 col-md-3 position-relative zoom">
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img {!! img_meta($gallery[3]->metadata) !!} class="lazy img-gallery-2" loading="lazy">
                            </a>
                        </div>
                        <div class="col-7 col-md-3 position-relative zoom">
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img {!! img_meta($gallery[4]->metadata) !!} class="lazy img-gallery" loading="lazy">
                            </a>
                        </div>
                        <div class="col-5 col-md-6 position-relative zoom">
                            <a href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <i class="bi bi-instagram icon-gallery"></i>
                                <img {!! img_meta($gallery[5]->metadata) !!} class="lazy img-gallery-2" loading="lazy">
                            </a>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col d-flex flex-column align-items-center">
                            <h3>Follow Us!</h3>
                            <div class="">

                                <a class="text-muted" href="{{ config('constants.FACEBOOK_URL') }}">
                                    <img src="{{ asset('img/svg/face-ico.svg') }}" loading="lazy" decoding="defer"
                                        alt="Tribune Travel facebook-icon" width="24" height="24">
                                </a>
                                <a class="text-muted" href="{{ config('constants.PINTEREST_URL') }}">
                                    <img src="{{ asset('img/svg/pint-ico.svg') }}" loading="lazy" decoding="defer"
                                        alt="Tribune Travel pint-icon" width="24" height="24">
                                </a>
                                <a class="text-muted" href="{{ config('constants.INSTAGRAM_URL') }}">
                                    <img src="{{ asset('img/svg/inst-ico.svg') }}" loading="lazy" decoding="defer"
                                        alt="Tribune Travel insta-icon" width="24" height="24">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php endif; ?>
            <!-- ads /21855382314/tt-home-lb-5 -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620239881317-0' class="col my-4 d-flex justify-content-center">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620239881317-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <!-- Gallery -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>

            <!-- Things  -->
            <h2 class="text-center my-4">Things To Do</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($thing as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {!! $data->destination !!}</span>
                                </a>
                                <span class="etiqueta-last-post">
                                    <i class="bi bi-star" style="font-size: 1rem; color:white; margin: 2px;"></i></span>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img {!! img_meta($data->image_data) !!} class="card-img">
                                    <h3 class="card-title-overlay">
                                        {!! $data->title !!}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{{ $data->title }}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 g-4 h-100">
                        @foreach ($things as $data)
                            @if ($thing[0]->id_post != $data->id_post)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row h-100">
                                            <div class="col card-head-secundario">
                                                <a href="{{ url("$data->url") }}">
                                                    <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post mb-2"
                                                        style="background:{{ $data->destination_color }};">
                                                        {!! $data->destination !!}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                </a>
                                                <small class="text-muted">
                                                    {{ date('M/d/Y', strtotime($data->post_date)) }}
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
                    <a href="{{ route('category', ['things-to-do']) }}" class="btn-view-more" type="button">More
                        Things to do</a>
                </div>
            </div>

            <!--ads /21855382314/tt-home-lb-footer -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620253311869-0' class="col text-center">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620253311869-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <!-- Things to do -->

            <!-- EVENTS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="row py-4">
                <h2 class="text-center mb-4">Featured Events</h2>
                <div class="owl-carousel owl-theme" id="events-carousel">
                    @foreach ($event as $data)
                        <div class="col-12" style="text-align: -webkit-center;">
                            <div class="row" style="max-width: 420px;">
                                <img {!! img_meta($data->image_data, null, true) !!} class="img-event">
                                <div class="col-3 py-0 h-50">
                                    @php
                                        $date = strtotime($data->start_date);
                                    @endphp
                                    <h2 class="align-middle">{{ date('M', $date) }}</h2>
                                    <h2 class="align-middle"><b>{{ date('d', $date) }}</b></h2>
                                </div>
                                <div class="col-9 py-0 text-start">
                                    <h3>{!! $data->title !!}</h3>
                                    <span>{!! $data->destination !!}</span><br>
                                    <small>{{ date('M d, Y', $date) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col my-4 d-flex justify-content-center">
                    <a href="{{ route('events') }}" class="btn-view-more" type="button">See the calendar</a>
                </div>
            </div>
            <!-- ads /21855382314/tt-home-lb-4 -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620236955324-0' class="col text-center">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620236955324-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <!-- EVENTS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <h2 class="text-center my-4">News</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($new as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {!! $data->destination !!}</span>
                                </a>
                                <span class="etiqueta-last-post">
                                    <i class="bi bi-star" style="font-size: 1rem; color:white; margin: 2px;"></i></span>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img {!! img_meta($data->image_data) !!} class="card-img">
                                    <h3 class="card-title-overlay">
                                        {!! $data->title !!}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{!! $data->title !!}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
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
                                                <a href="{{ url("$data->url") }}">
                                                    <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post mb-2"
                                                        style="background:{{ $data->destination_color }};">
                                                        {!! $data->destination !!}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                </a>
                                                <small class="text-muted">
                                                    {{ date('M/d/Y', strtotime($data->post_date)) }}
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
                    <a href="{{ route('category', ['news']) }}" class="btn-view-more" type="button">More
                        News</a>
                </div>
            </div>
            <!-- NEWS -->
            <!--ads /21855382314/tt-home-lb-footer -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620253311869-0' class="col text-center">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620253311869-0');
                            });
                        </script>
                    </div>
                </div>
            @endif
            <!-- News -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- Blogs -->
            <h2 class="text-center my-4">Blogs</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    @foreach ($blog as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {!! $data->destination !!}</span>
                                </a>
                                <span class="etiqueta-last-post">
                                    <i class="bi bi-star" style="font-size: 1rem; color:white; margin: 2px;"></i></span>
                                <a href="{{ url("$data->url") }}">
                                    <div class="opacity-effect" style="border-radius: 1rem 1rem 0 0;"></div>
                                    <img {!! img_meta($data->image_data) !!} class="card-img">
                                    <h3 class="card-title-overlay">
                                        {!! $data->title !!}
                                    </h3>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ url("$data->url") }}" title="{!! $data->title !!}" class="">
                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </p>
                                </a>
                                <small class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 g-4 h-100">
                        @foreach ($blogs as $data)
                            @if ($blog[0]->id_post != $data->id_post)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row h-100">
                                            <div class="col card-head-secundario">
                                                <a href="{{ url("$data->url") }}">
                                                    <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post mb-2"
                                                        style="background:{{ $data->destination_color }};">
                                                        {!! $data->destination !!}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                </a>
                                                <small class="text-muted">
                                                    {{ date('M/d/Y', strtotime($data->post_date)) }}
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
                    <a href="{{ route('category', ['blogs']) }}" class="btn-view-more" type="button">More
                        Blogs</a>
                </div>
            </div>
            <!-- NEWS -->
            <!--ads /21855382314/tt-home-lb-footer -->
            @if ($mostrar)
                <div class="row slot">
                    <div id='div-gpt-ad-1620253311869-0' class="col text-center ">
                        <script defer>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620253311869-0');
                            });
                        </script>
                    </div>
                </div>
            @endif

    </main>
@endsection
