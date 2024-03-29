@extends('layouts.app')
@section('page-title')
    {!! $category_data[0]->name !!} |
@endsection
@php
    $mostrar = true;
@endphp
@if ($mostrar)
    @push('ads')
        <!-- Tribune Top Leaderboard Categorías -->
        <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
        <script defer>
            window.googletag = window.googletag || {
                cmd: []
            };
            googletag.cmd.push(function() {
                googletag.defineSlot('/21855382314/tt-categories-lb-1', [
                    [728, 90],
                    [300, 100],
                    [320, 50],
                    [970, 90]
                ], 'div-gpt-ad-1661981600269-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-categories-lb-2', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661982257390-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-categories-lb-3', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661983073792-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-categories-lb-4', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661983352750-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-categories-lb-5', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661983499701-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
    @endpush
@endif
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 60px;">
        <div class="container">
            @if ($category_data[0]->name != 'Daily Briefing')
                @include('menus.sub_menu_destinations')
            @endif
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-categories-lb-1 -->
                        <div id='div-gpt-ad-1661981600269-0' style='min-width: 300px; min-height: 50px;'>
                            <script defer>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661981600269-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row g-4">
                <h1>Tribune {{ $category_data[0]->name }}</h1>
                @isset($firstpostcategory)
                    <div class="col-12">
                        <div class="card card-principal-post">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card border-0">
                                        @if ($category_data[0]->name != 'Daily Briefing')
                                            <a href="{{ route('destinations', ["$firstpostcategory->destination_slug"]) }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{{ $firstpostcategory->destination_color }};">{{ $firstpostcategory->destination }}</span>
                                            </a>
                                        @endif
                                        @php
                                            if ($category_data[0]->name === 'Daily Briefing') {
                                                $post_route = route('post_daily', $firstpostcategory->slug);
                                            } else {
                                                $post_route = url("$firstpostcategory->url");
                                            }
                                        @endphp
                                        <a href="{{ $post_route }}" title="Click to see more"
                                            class="text-decoration-none text-muted">
                                            {{-- @if ($firstpostcategory->id_post == $data->id_post) --}}
                                            <span class="badge etiqueta-destacado">
                                                <img src="{{ asset('img/estrella.webp') }}" alt="destacada" width="25"
                                                    height="25">
                                            </span>
                                            {{-- @endif --}}
                                            <div class="opacity-effect" style="border-radius: 1rem"></div>
                                            <img {!! img_meta($firstpostcategory->image_data, $firstpostcategory->image_alt) !!}" class="img-category-principal">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <a href="{{ $post_route }}" title="Click to see more" class="text-decoration-none">
                                        <div class="card-body">
                                            <h3 class="">
                                                {{ $firstpostcategory->title }}
                                            </h3>
                                            <p class="card-text">
                                                {!! Str::limit(strip_tags($firstpostcategory->post_excerpt), 225, ' ...') !!}
                                            </p>
                                            <small class="text-muted text-end">
                                                {{ date('M/d/Y', strtotime($firstpostcategory->post_date)) }}
                                            </small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                @if ($mostrar)
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-categories-lb-2 -->
                        <div id='div-gpt-ad-1661982257390-0' style='min-width: 320px; min-height: 50px;'>
                            <script defer>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661982257390-0');
                                });
                            </script>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="row row-cols-2 row-cols-lg-4 g-3">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @php
                                if ($category_data[0]->name === 'Daily Briefing') {
                                    $post_route = route('post_daily', $data->slug);
                                } else {
                                    $post_route = url("$data->url");
                                }
                            @endphp
                            @if ($i >= 2 && $i <= 5)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row g-3">
                                            <div class="col-12 col-sm-6 col-lg-12">

                                                @if ($category_data[0]->name != 'Daily Briefing')
                                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                        <span class="badge etiqueta-img"
                                                            style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                    </a>
                                                @endif
                                                <a href="{{ $post_route }}" title="Click to see more">
                                                    <img {!! img_meta($data->image_data, $data->image_alt) !!} class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-12">
                                                <div class="card-body-secundario h-100">
                                                    <a href="{{ $post_route }}" title="Click to see more"
                                                        class="text-decoration-none text-muted">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                    </a>
                                                    <small class="text-muted">
                                                        {{ date('M/d/Y', strtotime($data->post_date)) }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                @if ($mostrar)
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-categories-lb-3 -->
                        <div id='div-gpt-ad-1661983073792-0' style='min-width: 320px; min-height: 50px;'>
                            <script defer>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661983073792-0');
                                });
                            </script>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        <?php $i = 1; ?>
                        <?php /* var_dump($postscategory[0]["title"]); */ ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 6)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        @if ($category_data[0]->name != 'Daily Briefing')
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                            </a>
                                        @endif
                                        <div class="card m-0 p-0 border-0">
                                            <a href="{{ url("$data->url") }}" title="Click to see more">
                                                <img {!! img_meta($data->image_data, $data->image_alt) !!} class="img-category-principal">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ url("$data->url") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                <h3 class="card-title">{{ $data->title }}
                                                </h3>
                                            </a>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    {{ date('M/d/Y', strtotime($data->post_date)) }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($mostrar)
                <div class="row my-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-categories-lb-4 -->
                        <div id='div-gpt-ad-1661983352750-0' style='min-width: 320px; min-height: 50px;'>
                            <script defer>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661983352750-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row my-4">
                <div class="col-12 cont-pagination d-flex justify-content-center">
                    {{ $postscategory->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
            @if ($mostrar)
                <div class="row my-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-categories-lb-5 -->
                        <div id='div-gpt-ad-1661983499701-0' style='min-width: 320px; min-height: 50px;'>
                            <script defer>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661983499701-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <script defer src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
