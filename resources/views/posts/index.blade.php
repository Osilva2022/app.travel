@extends('layouts.app')

<!-- Metadatos -->


<!-- content -->
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row mb-2">
                <!-- MENU RUTA -->
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route( $category) }}">{{ $category }}</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $post->title }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
                <div class="col-12">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="col-12">
                    <img src="{{ $post->image }}" alt="" width="100%" height="auto"
                        style="max-height: 410px; max-width: 720px;">
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
                                <h5 class="card-title">By <b>{{$post->author_name}}</b></h5>
                                <p class="card-text"><small class="text-muted">{{$post->post_date}}</small></p>
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
                                <h5 class="card-title text-center">By {{$post->author_name}}</h5>
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
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
