@extends('layouts.app')
@section('page-title')
    {!! $destination_data[0]->name !!} |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ images($destination_data[0]->image) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{!! $destination_data[0]->name !!}</h1>
                <p class="text-white">
                    {!! $destination_data[0]->description !!}
                </p>
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container" style="max-width: 1024px;">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    @foreach ($destinationposts as $data)
                        <div class="col">
                            <div class="card card-especial zoom">
                                @foreach ($data->terms['category'] as $key => $val)
                                    <a href="{{ route('category', "$key") }}">
                                        @foreach ($categories_data as $cat)
                                            @if ($cat->slug == $key)
                                                <span class="badge etiqueta-img"
                                                    style="background:{!! $cat->color !!};">{!! $val !!}</span>
                                            @endif
                                        @endforeach
                                    </a>
                                @endforeach
                                <a href="{{ url("$data->slug") }}" class="text-decoration-none text-muted">
                                    @php
                                        // var_dump($data->thumbnail->size());
                                    @endphp
                                    <img src="{!! img_meta($data->thumbnail) !!}" class="card-img-estatica">
                                    <div class="card-body">
                                        <h3 class="card-title">{!! $data->title !!}</h3>
                                        <p class="card-text">{!! $data->post_excerpt !!}</p>
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
