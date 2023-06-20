@extends('layouts.app')
@section('page-title')
    Guide |
@endsection
@php
    $mostrar = true;
@endphp
@if ($mostrar)
    @push('ads')
        <!-- Tribune Top Leaderboard Guide -->
        <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
        <script defer>
            window.googletag = window.googletag || {
                cmd: []
            };
            googletag.cmd.push(function() {
                googletag.defineSlot('/21855382314/tt-guide-lb-1', [
                    [970, 90],
                    [320, 50],
                    [300, 100],
                    [728, 90]
                ], 'div-gpt-ad-1661985509466-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-guide-lb-2', [
                    [320, 50],
                    [728, 90]
                ], 'div-gpt-ad-1661985704739-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-guide-lb-3', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661986333879-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-guide-lb-4', [
                    [320, 50],
                    [728, 90]
                ], 'div-gpt-ad-1661986455608-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
    @endpush
    @section('styles')
        @livewireStyles
    @endsection
@endif
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 60px;">
        <div class="bg-light hero-image" style="background-image: url({{ imgURL($destination_data[0]->image_data) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{!! $destination_data[0]->name !!}</h1>
                <p class="text-white">
                    {!! $destination_data[0]->description !!}
                </p>
            </div>
        </div>
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <div class="cont-menu-destination" style="overflow-x: auto; padding-bottom: 8px;">
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="min-width: 678px;">
                            @foreach ($destinations_data as $data)
                                <li class="nav-item nav-test mx-1" role="presentation">
                                    <a class="nav-link {{ $data->slug == $destination ? 'active' : '' }}"
                                        id="{!! $data->slug !!}-tab"
                                        href="{{ url('guide') }}?destination={!! $data->slug !!}" type="button">
                                        <small>{!! $data->name !!}</small></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-lb-1 -->
                        <div id='div-gpt-ad-1661985509466-0' style='min-width: 300px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661985509466-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2>Guide</h2>
                    <p>There is always something new to discover. <br>
                        Learn about the best spots you can visit to dine, sip, pamper yourself and have the best of times.
                    </p>
                </div>
            </div>
            {{-- @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-lb-2 -->
                        <div id='div-gpt-ad-1661985704739-0' style='min-width: 320px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661985704739-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 my-4">
                @foreach ($things_categories as $tc)
                    <div class="col">
                        <a href="{{ route('guide_category', ["$destination", "$tc->slug"]) }}" class="text-decoration-none">
                            <div class="card border-0">
                                <div class="position-relative zoom">
                                    <div class="opacity-effect"
                                        style="border-radius: 1rem; background:{!! $tc->category_color !!};"></div>
                                    <img {!! img_meta($tc->image_data, $tc->image_alt) !!} class="card-img-secundario">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title" style="color:{!! $tc->category_color !!};">
                                        {!! $tc->name !!}
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
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-lb-3 -->
                        <div id='div-gpt-ad-1661986333879-0' style='min-width: 320px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661986333879-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-lb-4 -->
                        <div id='div-gpt-ad-1661986455608-0' style='min-width: 320px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661986455608-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
    {{-- <script src="{{ asset('js/submenu.js') }}" version="1"></script> --}}
@endsection
@push('scripts')
    @livewireScripts
@endpush
