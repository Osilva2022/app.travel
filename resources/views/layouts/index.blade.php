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
            <div class="row my-4">
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
                                <div class="card-img-overlay" style="top: auto;">
                                    <a href="{{ url("$data->url") }}">
                                        <h3 class="card-title-overlay">
                                            {{ $data->title }}
                                        </h3>
                                    </a>
                                </div>
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
                        <div class="col-12">
                            @foreach ($reviews as $data)
                                @if ($review[0]->id_post != $data->id_post)
                                    <div class="row card-secundario">
                                        <div class="col-auto">
                                            <a
                                                href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                <img src="{{ $data->image }}" class="card-img-secundario">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="etiqueta-post mb-2"
                                                    style="background:{{ $data->destination_color }};">
                                                    {{ $data->destination }}
                                                </span>
                                            </a>
                                            <a
                                                href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                                <h3 class="mb-1">{{ $data->title }}</h3>
                                            </a>
                                            <small>
                                                {{ date('M/d/y', strtotime($data->post_date)) }}
                                            </small>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2">
                    <a href="{{ route('reviews') }}" class="btn-view-more" type="button">More
                        Reviews</a>
                </div>
            </div>
            <!-- REVIEWS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- TTD -->
            <div class="row my-4">
                <h2 class="text-center mb-4">Things To Do</h2>
                <div class="col-12">
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
                                        <div id="tag-carousel" class="carousel slide mb-2" data-bs-ride="carousel">
                                            <div class="carousel-inner shadow rounded-4">
                                                <?php $i = 1; ?>
                                                @foreach ($things as $ttd)
                                                    @if ($data->slug == $ttd->destination_slug)
                                                        <?php $active = ''; ?>
                                                        @if ($i == 1)
                                                            <?php $active = 'active show'; ?>
                                                        @endif
                                                        <div class="carousel-item {{ $active }}">
                                                            {{-- <div class="w-100 h-100"
                                                                style="background-color: {{ $ttd->category_color }}; bottom:0; left:0; z-index:12; opacity:50%;">
                                                            </div> --}}
                                                            <img src="{{ $ttd->image }}" class="bd-placeholder-img-lg"
                                                                width="100%" height="100%" aria-hidden="true"
                                                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                                            <div class="container">
                                                                <div class="position-absolute w-100 h-100"
                                                                    style="background-color: {{ $ttd->category_color }}; top:0; left:0; z-index:1; opacity:50%;">
                                                                </div>
                                                                <div class="carousel-caption text-start"
                                                                    style="bottom:4px; z-index:2;">
                                                                    <h4>{{ $ttd->title }}</h4>
                                                                    <p style="bottom:4px;">{{ $ttd->category }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="carousel-indicators position-relative">
                                                <?php $i = 0; ?>
                                                @foreach ($things as $ttd)
                                                    @if ($data->slug == $ttd->destination_slug)
                                                        <?php $active = ''; ?>
                                                        @if ($i == 0)
                                                            <?php $active = 'active'; ?>
                                                        @endif
                                                        <button type="button" data-bs-target="#tag-carousel"
                                                            data-bs-slide-to="{{ $i }}"
                                                            class="bg-primary  {{ $active }}" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <a href="{{ route('things') }}" class="btn-view-more" type="button">More
                                            things to do {{ $data->name }}</a>
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
            <div class="row my-4">
                <h2 class="text-center mb-4">Featured Events</h2>
                <div class="col-12" style="text-align: -webkit-center;">
                    <div class="row" style="max-width: 420px;">
                        @foreach ($event as $data)
                            <img src="{{ $data->image }}" class="bd-placeholder-img-lg img-fluid mb-3"
                                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <div class="col-3 border-end border-primary border-3 py-0 h-50">
                                @php
                                    $date = strtotime($data->start_date);
                                @endphp
                                <h2 class="align-middle">{{ date('M', $date) }}</h2>
                                <h2 class="align-middle"><b>{{ date('d', $date) }}</b></h2>
                            </div>
                            <div class="col-9 py-0 text-start">
                                <h3>{{ $data->title }}</h3>
                                <p>{{ date('M d, Y', $date) }}<br>{{ $data->destination }}</p>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('events') }}" class="btn-view-more" type="button">See the calendar</a>
                </div>
            </div>
            <!-- EVENTS -->
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <div class="row my-4">
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
                                <div class="card-img-overlay" style="top: auto;">
                                    <a
                                        href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                        <h3 class="card-title-overlay">
                                            {{ $data->title }}
                                        </h3>
                                    </a>
                                </div>
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
                                <div class="row card-secundario">
                                    <div class="col-auto">
                                        <a
                                            href="{{ url("$data->destination_slug/$data->category_slug/post/$data->slug") }}">
                                            <img src="{{ $data->image }}" class="card-img-secundario">
                                        </a>
                                    </div>
                                    <div class="col">
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
    <ul id="galeria-instagram"></ul>

<script>
var token = 'IGQVJYeE9qMmp1Y3VvVEtNRmhkTGhZAVklOWHBUeHdQX014X0tjYjZAHODV4YURlS1d5TjhFXzcydWlSeUtwX0tzckJZARDdLT05ralNnaWYycDAyRTZAVbmdOcFdoMTF3QS1TWUpReWdyOUZAfT3doNk5uNwZDZD',
    username = 'danielruiz5328', // rudrastyh - my username :)
    num_photos = 4;
 
$.ajax({ // the first ajax request returns the ID of user rudrastyh
	url: 'https://api.instagram.com/v1/users/search',
	dataType: 'jsonp',
	type: 'GET',
	data: {access_token: token, q: username}, // actually it is just the search by username
	success: function(data){
		console.log(data);
		$.ajax({
			url: 'https://api.instagram.com/v1/users/' + data.data[0].id + '/media/recent', // specify the ID of the first found user
			dataType: 'jsonp',
			type: 'GET',
			data: {access_token: token, count: num_photos},
			success: function(data2){
				console.log(data2);
				for(x in data2.data){
					$('#galeria-instagram').append('<li><img src="'+data2.data[x].images.thumbnail.url+'"></li>');  
				}
    			},
			error: function(data2){
				console.log(data2);
			}
		});
	},
	error: function(data){
		console.log(data);
	}
});
</script>


@endsection
