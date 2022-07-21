@extends('layouts.app')
<!-- Metadatos -->

<!-- content -->
@section('content')
    <header>
        @include('menus.menu')
        @include('layouts.carousel')
    </header>
    <main>
        <div class="container">
            <!-- REVIEWS -->
            <div class="row py-4">
                <h2 class="mb-4">Tribune Reviews</h2>
                <div class="col-lg-6">
                    @foreach ($review as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                    <span class="badge etiqueta-img" style="background:{{ $data->destination_color }};">
                                        {{ $data->destination }}</span>
                                </a>
                                <span class="badge etiqueta-destacado">
                                    <img src="{{ asset('img/estrella.png') }}" alt="destacada" width="30"
                                        height="30">
                                </span>
                                <a href="{{ url("$data->url") }}">
                                    <img src="{{ $data->image }}" class="card-img">
                                </a>
                                <a href="{{ url("$data->url") }}">
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
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($reviews as $data)
                            @if ($review[0]->id_post != $data->id_post)
                                <div class="col-12 col-md-4">
                                    <div class="row card-secundario">
                                        <div class="col-6 col-md-12 card-head-secundario">
                                            <a
                                                href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                <img src="{{ $data->image }}" class="card-img-secundario">
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-12 card-body-secundario">
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
                            @endif
                        @endforeach
                        <div class="col-12 my-2">
                            <a href="{{ route('reviews') }}" class="btn-view-more" type="button">More
                                Reviews</a>
                        </div>
                    </div>
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
                            <div class="tab-pane fade  {{ $active }}" id="tag-{{ $data->term_id }}" role="tabpanel"
                                aria-labelledby="{{ $data->term_id }}-tab">
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
                                                    <div class="">
                                                        <a
                                                            href="{{ route('things_category', ["$ttd->destination_slug", "$ttd->category_slug"]) }}">
                                                            <img src="{{ $ttd->image }}" class="carousel-img">
                                                            <div class="container">
                                                                {{-- <div class="position-absolute w-100 h-100"
                                                                    style="background-color: {{ $ttd->category_color }}; top:0; left:0; z-index:1; opacity:50%;">
                                                                </div> --}}
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
                                    <div class="col-12 my-3">
                                        <a href="{{ route('things') }}" class="btn-view-more" type="button">Explore
                                            {{ $data->name }}</a>
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
            <!-- EVENTS -->
            <div class="row py-4">
                <h2 class="text-center mb-4">Featured Events</h2>
                <div class="owl-carousel owl-theme" id="events-carousel">
                    @foreach ($event as $data)
                        <div class="col-12" style="text-align: -webkit-center;">
                            <div class="row" style="max-width: 420px;">
                                <img src="{{ $data->image }}" class="img-event">
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
                <a href="{{ route('events') }}" class="btn-view-more my-3" type="button">See the calendar</a>
            </div>
            <!-- EVENTS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <div class="row py-4">
                <h2 class="mb-4">News</h2>
                <div class="col-lg-6">
                    @foreach ($new as $data)
                        <div class="card card-principal-post">
                            <div class="card border-0">
                                <a href="{{ route('destinations', ["$data->destination"]) }}">
                                    <span class="badge etiqueta-img"
                                        style="font-size:1rem;background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                </a>
                                <a href="{{ url("$data->url") }}" class="">
                                    <img src="{{ $data->image }}" class="card-img">
                                </a>
                                {{-- <div class="card-img-overlay" style="top: auto;"> --}}
                                <a href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                    <h3 class="card-title-overlay">
                                        {{ $data->title }}
                                    </h3>
                                </a>
                                {{-- </div> --}}
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
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($news as $data)
                            @if ($new[0]->id_post != $data->id_post)
                                <div class="col-12 col-md-4">
                                    <div class="row card-secundario">
                                        <div class="col-6 col-md-12 card-head-secundario">
                                            <a
                                                href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                <img src="{{ $data->image }}" class="card-img-secundario">
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-12 card-body-secundario">
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="etiqueta-post mb-2"
                                                    style="background:{{ $data->destination_color }};">
                                                    {{ $data->destination }}
                                                </span>
                                            </a>
                                            <a href="{{ url("$data->url") }}">
                                                <h3 class="mb-1">{{ $data->title }}</h3>
                                            </a>
                                            <small class="text-muted">
                                                {{ date('M/d/y', strtotime($data->post_date)) }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-12 my-4">
                            <a href="{{ route('news') }}" class="btn-view-more" type="button">More
                                news</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- NEWS -->
    </main>
    
@endsection
