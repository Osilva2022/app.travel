@extends('layouts.app')
<!-- Metadatos -->

<!-- content -->
@section('content')
    <header>
        @include('menus.menu')
        @include('layouts.carousel')
        @php 
        $destination = array_keys($review->terms['post_destinos'])[0];
        $category = array_keys($review->terms['category'])[0];
        @endphp
    </header>
    <main>
        <div class="container">
            <!-- REVIEWS -->
            <div class="row">
                <h4>Tribune Reviews</h4>
                <div class="col-lg-6">
                    <div class="card mb-3 border-0">
                        <div class="card border-0">
                            <img src="{{ $review->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                                width="100%" height="220">
                            <a href="{{ url("$destination/$category/$review->slug") }}" title="{{ $review->title }}"
                                class="text-decoration-none text-muted">
                                <div class="card-img-overlay text-white h-100">
                                    @foreach ($destinations_data as $dd)                                    
                                        @if ($dd->name == array_values($review->terms['post_destinos'])[0])    
                                        <a href="{{ url("$destination/$category") }}">                               
                                            <span class="badge" style="background:{{ $dd->meta_value }};">{{ $dd->name }}</span>
                                        </a>
                                        @endif
                                    @endforeach
                                    <span class="badge float-end">
                                        <img src="{{ asset('img/estrella.png') }}" alt="destacada" width="25"
                                            height="25">
                                    </span>
                                    <h5 class="card-title position-absolute" style="bottom: 1.5rem;">
                                        {{ $review->title }}
                                    </h5>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ url("$destination/$category/$review->slug")  }}" title="{{ $review->title }}"
                                    class="text-decoration-none text-muted test-error">
                                    {!! Str::limit(strip_tags($review->excerpt), 175, ' ...') !!}
                                </a>
                            </p>
                            <p class="card-text"><small
                                    class="text-muted">{{ $review->post_date->format('d M Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            @foreach ($reviews as $data)
                            @php 
                            $destination = array_keys($data->terms['post_destinos'])[0];
                            $category = array_keys($data->terms['category'])[0];
                            @endphp
                                @if ($review->ID != $data->ID)
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="{{ url("$destination/$category/$data->slug") }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="150">
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <div class="card-body">
                                                    @foreach ($destinations_data as $dd)
                                                        @if ($dd->name == array_values($data->terms['post_destinos'])[0])
                                                        <a href="{{ url("$destination/$category") }}">
                                                            <span class="card-title badge fs-6" style="background:{{ $dd->meta_value }};">
                                                                {{ $dd->name }}
                                                            </span>
                                                        </a>
                                                        @endif
                                                    @endforeach
                                                    <p class="card-text">                                                        
                                                        <a href="{{ url("$destination/$category/$data->slug") }}" class="text-decoration-none text-muted">
                                                            {!! Str::limit($data->title, 100, ' ...') !!}
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{ $data->post_date->format('d M Y') }}
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
                            <a href="{{ route('category', 'Reviews') }}"
                                class="btn btn-primary form-control rounded-pill" type="button">More
                                Reviews of Destination</a>
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
                <h4 class="text-center mb-3">Things To Do</h4>
                <div class="col-12">
                    <div class="" style="overflow-x: auto;">
                        <ul class="nav nav-tabs justify-content-center mb-3" id="myTab" role="tablist"
                            style="min-width: 390px;">
                            @foreach ($destinations_data as $data)
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
                        @foreach ($destinations_data as $data)
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
                                        <a class="btn btn-primary form-control rounded-pill" type="button">More
                                            things
                                            to do</a>
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
            <!-- NEWS -->
            @php 
            $destination = array_keys($new->terms['post_destinos'])[0];
            $category = array_keys($new->terms['category'])[0];
            @endphp
            <div class="row">
                @php
                    $destination = array_keys($new->terms['post_destinos'])[0];
                    $category = array_keys($new->terms['category'])[0];
                @endphp
                <h4>News</h4>
                <div class="col-lg-6">
                    <div class="card mb-4 border-0">
                        <img src="{{ $new->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                            width="100%" height="220">
                        <a href="{{ url("$destination/$category/$review->slug") }}" title="{{ $new->title }}"
                            class="text-decoration-none text-muted">
                            <div class="card-img-overlay text-white">
                                @foreach ($destinations_data as $dd)
                                    @if ($dd->name == array_values($new->terms['post_destinos'])[0])
                                        <a href="{{ url("$destination/$category") }}">
                                            <span class="badge" style="background:{{ $dd->meta_value }};">{{ $dd->name }}</span>
                                        </a>
                                    @endif
                                @endforeach
                                <h5 class="card-title position-absolute" style="bottom: 1.5rem;">{{ $new->title }}
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($news as $data)
                        @php 
                        $destination = array_keys($data->terms['post_destinos'])[0];
                        $category = array_keys($data->terms['category'])[0];
                        @endphp
                            @if ($new->ID != $data->ID)
                                <div class="col-12">
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="{{ url("$destination/$category/$review->slug") }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="180">
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <div class="card-body">
                                                    @foreach ($destinations_data as $dd)
                                                        @if ($dd->name == array_values($data->terms['post_destinos'])[0])                                                            
                                                            <a href="{{ url("$destination/$category") }}">
                                                                <span class="card-title badge fs-6" style="background:{{ $dd->meta_value }};">
                                                                    {{ $dd->name }}
                                                                </span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                    <p class="card-text">
                                                        <a href="{{ url("post/$destination/$category/$review->slug") }}"class="text-decoration-none text-muted">
                                                            {!! Str::limit($data->title, 100, ' ...') !!}
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{ $data->post_date->format('d M Y') }}
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
                            <a href="{{ route('category', 'News') }}"
                                class="btn btn-primary form-control rounded-pill" type="button">More
                                news</a>
                        </div>
                    </div>
                </div>
                <!-- NEWS -->

                
                <div class="row justify-content-center">
                    <div class="col-4  pb-2 mb-2">
                        <hr>
                        <a href="{{ route("events") }}"  class="btn btn-primary form-control rounded-pill" type="button">Events</a>
                    </div>
                </div>
            </div>
    </main>
@endsection
