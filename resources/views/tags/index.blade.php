@extends('layouts.app')
@section('page-title')
    {!! $tag_data[0]->name !!} |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.8rem;">
        <div class="album pb-5 bg-light">
            <div class="container" style="max-width: 1024px;">
                <div class="row mb-4">
                    <div class="col">
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="min-width: 678px;">
                            @foreach ($tags_data as $data)
                                <li class="nav-item nav-test mx-1" role="presentation">
                                    <a class="nav-link {{ $data->slug == $tag_data[0]->slug ? 'active' : '' }}"
                                        href="{{ route('tags', $data->slug) }}" type="button">
                                        <small>{!! $data->name !!}</small></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    @foreach ($destinationposts as $data)
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
                <!-- BOTONES CATEGORIAS -->
                @include('menus.menu_footer_categories')
                <!-- BOTONES CATEGORIAS -->
            </div>
        </div>
    </main>
@endsection
