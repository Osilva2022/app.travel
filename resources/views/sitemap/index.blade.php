@extends('layouts.app')
@section('page-title')
    Policies |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.8rem;">
        <div class="container py-4" style="max-width: 920px;">
            <div class="row my-2">
                <div class="col-12">
                    <h1>Sitemap</h1>
                </div>
            </div>
            <div class="row my-2 g-4">
                <h2 class="text-center">Destinations</h2>
                @foreach ($destinations_data as $destination)
                    <div class="col text-center">
                        <h3>
                            <a class="" href="{!! route('destinations', ["$destination->slug"]) !!}">
                                {!! $destination->name !!}
                            </a>
                        </h3>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row my-2 g-4">
                <h2 class="text-center">Categories</h2>
                @foreach ($categories_data as $category)
                    <div class="col text-center">
                        <h3>
                            <a class="" href="{!! route('category', ["$category->slug"]) !!}">{!! $category->name !!}</a>
                        </h3>
                    </div>
                @endforeach
                <div class="col text-center">
                    <h3>
                        <a class="" href="{!! route('guide') !!}">Guide</a>
                    </h3>
                </div>
                <div class="col text-center">
                    <h3>
                        <a class="" href="{!! route('events') !!}">Events</a>
                    </h3>
                </div>
            </div>
            <hr>
            <div class="row mt-2 mb-4 g-4">
                <h2 class="text-center">Tags</h2>
                @foreach ($tags_data as $tag)
                    <div class="col text-center">
                        <a class="" href="{!! route('tags', ["$tag->slug"]) !!}">
                            <h4>
                                {!! $tag->name !!}
                            </h4>
                        </a>
                    </div>
                @endforeach
            </div>
            <hr>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
