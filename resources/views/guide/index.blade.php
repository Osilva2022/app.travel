@extends('layouts.app')
@section('page-title')
Guide |
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
        <div class="container" style="max-width: 1024px;">
            <div class="row mb-4">
                <div class="col">
                    <div class="cont-menu-destination" style="overflow-x: auto; height: 60px;">
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="min-width: 678px;">
                            @foreach ($destinations_data as $data)
                                <li class="nav-item nav-test mx-1" role="presentation">
                                    <a class="nav-link" id="{!! $data->slug !!}-tab"
                                        href="{{ url("guide") }}?destination={!! $data->slug !!}" type="button">
                                        <small>{!! $data->name !!}</small></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Guide</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum est, cumque dicta officiis fuga
                        maiores? Quod esse et voluptatem corporis dolor deleniti reprehenderit incidunt iusto? Ad deserunt
                        minus neque vero!</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                @foreach ($things_categories as $tc)
                    <div class="col">
                        <a href="{{ route('guide_category', ["$destination", "$tc->category_slug"]) }}"
                            class="text-decoration-none">
                            <div class="card border-0">
                                <div class="position-relative zoom">
                                    <div class="opacity-effect"
                                        style="border-radius: 1rem; background:{!! $tc->category_color !!};"></div>
                                    <img src="{!! images($tc->image) !!}" class="card-img-secundario">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title" style="color:{!! $tc->category_color !!};">
                                        {!!  $tc->category !!}
                                    </h3>
                                    <p class="card-text" style="color: #7B7F84;">
                                        {!! $tc->description !!}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
