@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ images($destination_data[0]->image) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{{ $destination_data[0]->name }}</h1>
                <p class="text-white">
                    {{ $destination_data[0]->description }}
                </p>
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container" style="max-width: 1024px;">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    @foreach ($destinationposts as $data)
                        <div class="col">
                            <div class="card card-especial zoom">
                                <a href="{{ route("$data->category_slug") }}">
                                    <span class="badge etiqueta-img"
                                        style="background:{{ $data->category_color }};">{{ $data->category }}</span>
                                </a>
                                <a href="{{ url("$data->url") }}" class="text-decoration-none text-muted">
                                    <img src="{{ images($data->image) }}" class="bd-placeholder-img card-img-top" width="100%"
                                        height="225">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $data->title }}</h3>
                                        <p class="card-text">{{ $data->post_excerpt }}</p>
                                        <small class="text-muted">{{ date('M/d/y', strtotime($data->post_date)) }}</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                    {{ $destinationposts->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </main>
@endsection
