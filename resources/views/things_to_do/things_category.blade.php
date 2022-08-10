@extends('layouts.app')
@section('page-title')
Things to Do |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ images($things_category[0]->image) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{{ $things_category[0]->name }}</h1>
                <p class="text-white">
                    {{ $things_category[0]->description }}
                </p>
            </div>
        </div>
        <div class="container">
            @include('menus.submenu_things')
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                @foreach ($things as $data)
                    <div class="col">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <h3 class="card-title">{{ $data->title }}</h3>
                                <p class="card-text">{!! $data->content !!}</p>
                            </div>
                            <img src="{{ images($data->image) }}" class="card-img-estatica">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                {{ $things->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <script src="{{ asset('js/submenu_things.js') }}" version="1"></script>
    </main>
@endsection
