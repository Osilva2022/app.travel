@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 60px;">
        <div class="bg-light hero-image"
            style="background-image: url({{ imgURL($destinations_data[0]->image_data) }}); height: 30vh;">
            {{-- <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{!! $destinations_data[0]->name !!}</h1>
                <p class="text-white">
                    {!! $destinations_data[0]->description !!}
                </p>
            </div> --}}
        </div>

        <div class="album pb-5">
            <div class="container">
                {{-- <div class="row mb-4">
                    <div class="col">
                        <div class="" style="overflow-x: auto; height: 60px;">
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="min-width: 678px;">
                                @foreach ($destinations_data as $data)
                                    <li class="nav-item nav-test mx-1" role="presentation">
                                        <a class="nav-link {{ $data->slug == $destination_data[0]->slug ? 'active' : '' }}"
                                            href="{{ route('destinations', $data->slug) }}" type="button">
                                            <small>{!! $data->name !!}</small></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- @if ($review)
                    <div class="row mb-4">
                        <div class="col destination-review" style="white-space: pre-wrap;">{!! $destination_data[0]->review !!}</div>
                    </div>
                @endif --}}
                <div class="row my-4">
                    <div class="col">
                        <h2>{!! $bandera ? 'Showing results' : 'No results found' !!} from : <i>"{!! $busqueda !!}"</i></h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mb-4">
                    @if ($bandera)
                        @foreach ($posts as $data)
                            <div class="col">
                                <div class="card card-especial zoom">
                                    <a href="{{ route('category', $data->category_slug) }}">
                                        <span class="badge etiqueta-img"
                                            style="background:{{ $data->category_color }};">{!! $data->category !!}</span>
                                    </a>
                                    <a href="{{ url("$data->url") }}" class="text-decoration-none text-muted">
                                        <img {!! img_meta($data->image_data) !!} class="card-img-especial">
                                        <div class="card-body">
                                            <h3 class="card-title">{!! $data->title !!}</h3>
                                            <p class="card-text">{!! $data->post_excerpt !!}</p>
                                            <small
                                                class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                    {{ $posts->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
                <!-- BOTONES CATEGORIAS -->
                @include('menus.menu_footer_categories')
                <!-- BOTONES CATEGORIAS -->
            </div>
        </div>
    </main>
@endsection
