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
            <div class="row">
                <h2>Tribune Reviews</h2>
                <div class="col-lg-6">
                    @foreach ($review as $data)
                        <div class="card mb-3 border-0">
                            <div class="card border-0">
                                <img src="{{ $data->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                                    width="100%" height="220">
                                <div class="card-img-overlay text-white h-100">
                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                        <span class="badge"
                                            style="font-size:1rem; background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                    </a>
                                    <span class="badge float-end">
                                        <img src="{{ asset('img/estrella.png') }}" alt="destacada" width="35"
                                            height="35">
                                    </span>
                                    <a href="{{ url("$data->url") }}"
                                        class="text-decoration-none">
                                        <h3 class="card-title position-absolute text-white" style="bottom: 1.5rem;">
                                            {{ $data->title }}
                                        </h3>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="{{ url("$data->url") }}"
                                        title="{{ $data->title }}" class="text-decoration-none text-muted test-error">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </a>
                                </p>
                                <p class="card-text"><small
                                        class="text-muted">{{  date('d/M/Y', strtotime($data->post_date))  }}</small>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            @foreach ($reviews as $data)
                                @if ($review[0]->id_post != $data->id_post)
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="150">
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <div class="card-body">
                                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                        <span class="card-title badge fs-6"
                                                            style="background:{{ $data->destination_color }};">
                                                            {{ $data->destination }}
                                                        </span>
                                                    </a>
                                                    <p class="card-text">
                                                        <a href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}"
                                                            class="text-decoration-none text-muted">
                                                            <h3>{!! Str::limit($data->title, 100, ' ...') !!}</h3>
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{  date('d/M/Y', strtotime($data->post_date))  }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                        <div class="col-12 my-4">
                            <a href="{{ route('reviews') }}" class="btn btn-primary form-control rounded-pill"
                                type="button">More
                                Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- REVIEWS -->
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <hr>
                </div>
            </div>
            <!-- TTD -->
            <div class="row">
                <h2 class="text-center mb-3">Things To Do</h2>
                <div class="col-12">
                    <div class="" style="overflow-x: auto;">
                        <ul class="nav nav-tabs justify-content-center mb-3" id="myTab" role="tablist"
                            style="min-width: 390px;">
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
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div id="tag-carousel" class="carousel slide mb-2" data-bs-ride="carousel">
                                            <div class="carousel-inner shadow rounded-4">
                                                <?php $i = 1; ?>
                                                @foreach ($tags_data as $data_tag)
                                                    <?php $active = ''; ?>
                                                    @if ($i == 1)
                                                        <?php $active = 'active show'; ?>
                                                    @endif
                                                    <div class="carousel-item {{ $active }}">
                                                        <img src="{{ asset('img/slider-1.jpg') }}"
                                                            class="bd-placeholder-img-lg" width="100%" height="100%"
                                                            aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                                                            focusable="false">
                                                        <div class="container">
                                                            <div class="carousel-caption text-start bottom-0">
                                                                <h5>{{ $data_tag->name }}</h5>
                                                                <p>Some representative placeholder content for the first
                                                                    slide.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $i++; ?>
                                                @endforeach
                                            </div>
                                            <div class="carousel-indicators position-relative">
                                                <?php $i = 0; ?>
                                                @foreach ($tags_data as $data_tag)
                                                    <?php $active = ''; ?>
                                                    @if ($i == 0)
                                                        <?php $active = 'active'; ?>
                                                    @endif
                                                    <button type="button" data-bs-target="#tag-carousel"
                                                        data-bs-slide-to="{{ $i }}"
                                                        class="bg-primary  {{ $active }}" aria-current="true"
                                                        aria-label="Slide 1"></button>
                                                    <?php $i++; ?>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <a href="{{ route('things') }}"
                                            class="btn btn-primary form-control rounded-pill" type="button">More
                                            things to do</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- TTD -->
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <hr>
                </div>
            </div>
            <!-- EVENTS -->
            <div class="row">
                <h2 class="text-center mb-3">Featured Events</h2>
                <div class="col-12" style="text-align: -webkit-center;">
                  
                    <div class="row justify-content-center" style="max-width: 420px;">
                        @foreach ($event as $data)
                            <img src="{{ $data->image }}" class="bd-placeholder-img-lg img-fluid mb-3"
                                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <div class="col-3 border-end border-primary border-3 text-end py-0 h-50">
                                @php
                                    $date = strtotime($data->start_date);
                                @endphp
                                <h2 class="align-middle">{{ date('M', $date) }}</h2>
                                <h2 class="align-middle"><b>{{ date('d', $date) }}</b></h2>
                            </div>
                            <div class="col-9 py-0">
                                <h3>{{ $data->title }}</h3>
                                <p>{{ date('M d, Y', $date) }}<br>{{ $data->destination }}</p>
                            </div>
                        @endforeach
                    </div>                   
                    
                    <a href="{{ route('events') }}" class="btn btn-primary form-control rounded-pill"
                        type="button">See the calendar</a>
                </div>
            </div>
            <!-- EVENTS -->
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <div class="row">
                <h2>News</h2>
                <div class="col-lg-6">
                    @foreach ($new as $data)
                        <div class="card mb-3 border-0">
                            <div class="card border-0">
                            <img src="{{ $data->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                                width="100%" height="220">
                            <div class="card-img-overlay text-white">
                                <a href="{{ route('destinations', ["$data->destination"]) }}">
                                    <span class="badge"
                                        style="font-size:1rem;background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                </a>
                                <a href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}"
                                    title="{{ $data->title }}" class="text-decoration-none text-white">
                                    <h3 class="card-title position-absolute" style="bottom: 1.5rem;">{{ $data->title }}
                                    </h3>
                                </a>
                            </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="{{ url("$data->url") }}"
                                        title="{{ $data->title }}" class="text-decoration-none text-muted test-error">
                                        {!! Str::limit(strip_tags($data->post_excerpt), 175, ' ...') !!}
                                    </a>
                                </p>
                                <p class="card-text"><small
                                        class="text-muted">{{  date('d/M/Y', strtotime($data->post_date))  }}</small>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($news as $data)
                            @if ($new[0]->id_post != $data->id_post)
                                <div class="col-12">
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="150">
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <div class="card-body">
                                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                        <span class="card-title badge fs-6"
                                                            style="background:{{ $data->destination_color }};">
                                                            {{ $data->destination }}
                                                        </span>
                                                    </a>
                                                    <p class="card-text">
                                                        <a
                                                            href="{{ url("$data->url") }}"class="text-decoration-none text-muted">
                                                            <h3>{!! Str::limit($data->title, 100, ' ...') !!}</h3>
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{  date('d/M/Y', strtotime($data->post_date))  }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-12 my-4">
                            <a href="{{ route('news') }}" class="btn btn-primary form-control rounded-pill"
                                type="button">More
                                news</a>
                        </div>
                    </div>
                </div>
                <!-- NEWS -->

                <div class="row justify-content-center">
                    <div class="col-4  pb-2 mb-2">

                    </div>
                </div>
            </div>
    </main>
@endsection
