@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
        @php
            //var_dump($destination_img);
        @endphp
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ $destination_data[0]->image }})">
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto text-white">
                        <h1>{{ $destination_data[0]->name }}</h1>
                        <p class="lead">
                            Something short and leading about the collection below—its contents, the
                            creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                            entirely.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    @foreach ($destinationposts as $data)
                        <div class="col">
                            <div class="card shadow-sm" style="height: 400px;">
                                <img src="{{ $data->image }}" class="bd-placeholder-img card-img-top" width="100%"
                                    height="225">
                                <div class="card-img-overlay text-white h-50">
                                    <a href="{{ route("$data->category_slug") }}">
                                        <span class="badge"
                                            style="background:{{ $data->category_color }};">{{ $data->category }}</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a href="{{ url("$data->url") }}"
                                        class="text-decoration-none text-muted">
                                        <h3 class="card-title">{{ $data->title }}</h3>
                                    </a>
                                    <p class="card-text">{!! Str::limit($data->post_excerpt, 50, ' ...') !!}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="position-relative">
                                            @isset($data->terms['tag'])
                                                @foreach (array_slice($data->terms['tag'], 0, 2) as $tag)
                                                    @foreach ($tag_data as $td)
                                                        @if ($tag == $td->name)
                                                            <a href="#" type="button" class="btn btn-sm p-1 text-light"
                                                                style=" font-size: small; background: {{ $td->meta_value }}">{{ $tag }}</a>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endisset
                                        </div>
                                        <small class="text-muted">{{ $data->post_date }}</small>
                                    </div>
                                </div>
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
