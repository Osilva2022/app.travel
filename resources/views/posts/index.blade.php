@extends('layouts.app')

<!-- Metadatos -->


<!-- content -->
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container" style="max-width: 1024px;">
            <div class="row mb-3">
                <div class="col col-md-4 col-lg-6">
                    <span class="badge etiqueta-categoria"
                        style="background-color: {{ $post->category_color }}">{{ $post->category }}</span>
                </div>
                <div class="col-auto col-md-3 col-lg-2">
                    Share:
                    <a rel="nofollow" class="fb-btn" href="javascript: void(0)"
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ url("$post->url") }}','sharer','toolbar=0,status=0,width=548,height=325');">
                        <img src="{{ asset('img/svg/face-ico.svg') }}" alt="Tribune Travel facebook-icon" width="17"
                            height="17">
                    </a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    <a class="text-muted" href="{{ config('constants.FACEBOOK_URL') }}">
                    </a>
                    <a class="text-muted" href="{{ config('constants.PINTERES_URL') }}" target="_blank">
                        <img src="{{ asset('img/svg/pint-ico.svg') }}" alt="Tribune Travel pint-icon" width="17"
                            height="17">
                    </a>
                    <a class="text-muted" href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                        <img src="{{ asset('img/svg/inst-ico.svg') }}" alt="Tribune Travel insta-icon" width="17"
                            height="17">
                    </a>
                </div>
            </div>
            <div class="row">
                <!-- MENU RUTA -->
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route($category) }}">{{ $post->category }}</a></li>
                            <li class="breadcrumb-item fw-bold" aria-current="page">{{ $post->title }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-7 col-lg-8">
                    <div class="row g-4">
                        <div class="col-12">
                            <img src="{{ images($post->image) }}" alt="" width="100%" height="auto"
                                style="aspect-ratio:16/9;">
                        </div>
                        <div class="col-12 mt-2">
                            {{-- <p class="text-caption">Sunset at Puerto Vallarta | Daniel López</p> --}}
                        </div>
                        <div class="col-12">
                            <h1>{{ $post->title }}</h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-auto text-end">
                                    <img src="{{ images($post->avatar) }}" class="img-fluid rounded-circle" alt="..."
                                        width="56" height="56">
                                </div>
                                <div class="col d-flex flex-column justify-content-center">
                                    <p class="card-title" style="color: #243A85">By
                                        <b>{{ $post->author_name }}</b>
                                    </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ date('F d, Y', strtotime($post->post_date)) }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- POST / NOTA -->
                        <div class="col-12 mb-4 px-4 mx-2 post-cont">
                            {!! $post->content !!}
                        </div>
                        <!-- POST / NOTA -->
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="card-more-posts p-4">
                        <div class="row row-cols-1 g-4 pb-4">
                            <h2 class="mb-0">More {{ $post->category }}</h2>
                            @foreach ($more_posts as $data)
                                <div class="col">
                                    <div class="card card-secundario">
                                        <div class="row">
                                            <div class="col card-head-secundario">
                                                <a
                                                    href="{{ url("$data->url") }}">
                                                    <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-6 card-body-secundario">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="etiqueta-post mb-2"
                                                        style="background:{{ $data->destination_color }};">
                                                        {{ $data->destination }}
                                                    </span>
                                                </a>
                                                <a href="{{ url("$data->url") }}">
                                                    <h3 class="card-title-secundario">{{ $data->title }}</h3>
                                                </a>
                                                <small class="text-muted">
                                                    {{ date('M/d/y', strtotime($data->post_date)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
