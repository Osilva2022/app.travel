@extends('layouts.app')

<!-- Metadatos -->


<!-- content -->
@section('content')
    <header>
        @include('posts.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row mb-2">
                <!-- MENU RUTA -->
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Reviews</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Post Title</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
                <div class="col-12">
                    <h4>{{ $post->post_title }}</h4>
                </div>
                <div class="col-12">
                    <img src="{{ $post->image }}" alt="" width="100%" height="auto" style="max-height: 410px; max-width: 720px;">
                </div>
                <div class="col-12 mb-4">
                    <h6>Image Caption</h6>
                </div>
                <div class="col-12">
                    <div class="card mb-3 border-0" style="max-width: 540px;">
                        <div class="row">
                            <div class="col-2 text-end">
                                <img src="{{ asset('img/xd.png') }}" class="img-fluid rounded-circle" alt="..."
                                    width="60" height="60">
                            </div>
                            <div class="col-8">
                                <h5 class="card-title">By Author</h5>
                                <p class="card-text"><small class="text-muted">Date xx, xxxx</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- POST / NOTA -->
                <div class="col-12 mb-4 post-cont">
                    {!! $post->content !!}
                </div>
                <!-- POST / NOTA -->
                <div class="col-12  pb-2 mb-2">
                    <hr>
                </div>
                <div class="col-12 mb-4">
                    <div class="card border-0">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{ asset('img/xd.png') }}" class="img-fluid rounded-circle" alt="..."
                                    width="60" height="60">
                            </div>
                            <div class="col-12">
                                <h5 class="card-title text-center">By Author</h5>
                                <p class="card-text">
                                    <small class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non
                                        officiis pariatur autem quae quo ipsam soluta error cupiditate id beatae rem
                                        laudantium, veniam maiores eligendi nobis, dolor possimus sunt tenetur! </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            <div class="row mb-4">
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="{{ asset('img/svg/ttd-ico.svg') }}" alt="" width="35" height="35">
                        <h5>Things to Do</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="{{ asset('img/svg/events-ico.svg') }}" alt="" width="35" height="35">
                        <h5>Events</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="{{ asset('img/svg/news-ico.svg') }}" alt="" width="35" height="35">
                        <h5>News</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="{{ asset('img/svg/dest-ico.svg') }}" alt="" width="35" height="35">
                        <h5>Destination</h5>
                    </button>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
