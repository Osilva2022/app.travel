@extends('layouts.app', ['title' => 'Authors'])

<!-- ads -->
@push('ads')
    <!-- Tribune Top Leaderboard Interior Notas -->
    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
    <script>
        window.googletag = window.googletag || {
            cmd: []
        };
        googletag.cmd.push(function() {
            googletag.defineSlot('/21855382314/tt-interior-lb-1', [
                [320, 50],
                [728, 90]
            ], 'div-gpt-ad-1620253079354-0').addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-lb-footer', [
                [250, 225],
                [728, 90]
            ], 'div-gpt-ad-1620254429918-0').addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-mr-1', [
                    [250, 225],
                    [300, 250]
                ], 'div-gpt-ad-1620254953532-0')
                .addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-mr-2', [
                    [250, 225],
                    [300, 250]
                ], 'div-gpt-ad-1620256146834-0')
                .addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-mr-3', [
                    [250, 225],
                    [300, 250]
                ], 'div-gpt-ad-1620256332338-0')
                .addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-mr-4', [
                    [250, 225],
                    [300, 250]
                ], 'div-gpt-ad-1620256703184-0')
                .addService(googletag.pubads());
            googletag.defineSlot('/21855382314/tt-interior-lb-2', [
                [320, 50],
                [728, 90]
            ], 'div-gpt-ad-1636587242560-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>
@endpush
@section('page-title')
    Author |
@endsection
<!-- content -->
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="container" style="max-width: 1024px;">
            <br>
            <div class="row g-4">
                <div class="col-12">
                    <div class="card-estatica p-4">
                        <div class="row g-3">
                            <div class="col-lg-auto d-flex justify-content-center align-items-center">
                                <img {!! img_meta($author->image_data) !!} class="img-fluid rounded-circle">
                            </div>
                            <div class="col d-flex flex-column justify-content-center text-center text-lg-start">
                                <h1 class="">Author</h1>
                                <h2>{!! $author->first_name !!} {!! $author->last_name !!}</h2>
                                <p style="margin-bottom: .5rem;">{!! $author->description !!}</p>
                                <span class="text-muted" style="font-size: small;">{!! $no_posts !!} Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col">
                            <div class="row row-cols-1 row-cols-md-2 g-3 mb-4">
                                @foreach ($posts as $data)
                                    <div class="col">
                                        <div class="card card-especial zoom">
                                            <a href="{{ route('category', "$data->category_slug") }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{!! $data->category_color !!};">{!! $data->category !!}</span>
                                            </a>
                                            <a href="{{ url("$data->url") }}" class="text-decoration-none text-muted">
                                                <img {!! img_meta($data->image_data) !!} class="card-img-especial">
                                                <div class="card-body">
                                                    <h3 class="card-title">{!! $data->title !!}</h3>
                                                    <p class="card-text">{!! $data->post_excerpt !!}</p>
                                                    <small class="text-muted">{!! date('M/d/y', strtotime($data->post_date)) !!}</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                                {{ $posts->appends($_GET)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 g-4">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 pb-4 px-0 g-4">
                        <div class="col">
                            <div class="card-add">
                                <!-- /21855382314/tt-interior-mr-1 -->
                                <div id="div-gpt-ad-1620254953532-0" class="text-center">
                                    <script>
                                        googletag.cmd.push(function() {
                                            googletag.display('div-gpt-ad-1620254953532-0');
                                        });
                                    </script>
                                </div>
                                <p class="text-muted text-center" style="font-size:10px; margin-bottom: 0;">
                                    ------ADVERTISEMENT------</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card-add">
                                <!-- /21855382314/tt-interior-mr-2 -->
                                <div id="div-gpt-ad-1620256146834-0" class="text-center">
                                    <script>
                                        googletag.cmd.push(function() {
                                            googletag.display('div-gpt-ad-1620256146834-0');
                                        });
                                    </script>
                                </div>
                                <p class="text-muted text-center" style="font-size:10px; margin-bottom: 0;">
                                    ------ADVERTISEMENT------</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card-add">
                                <!-- /21855382314/tt-interior-mr-3 -->
                                <div id="div-gpt-ad-1620256332338-0" class="text-center">
                                    <script>
                                        googletag.cmd.push(function() {
                                            googletag.display('div-gpt-ad-1620256332338-0');
                                        });
                                    </script>
                                </div>
                                <p class="text-muted text-center" style="font-size:10px; margin-bottom: 0;">
                                    ------ADVERTISEMENT------</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card-add">
                                <!-- /21855382314/tt-interior-mr-4 -->
                                <div id="div-gpt-ad-1620256703184-0" class="text-center">
                                    <script>
                                        googletag.cmd.push(function() {
                                            googletag.display('div-gpt-ad-1620256703184-0');
                                        });
                                    </script>
                                </div>
                                <p class="text-muted text-center" style="font-size:10px; margin-bottom: 0;">
                                    ------ADVERTISEMENT------</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="row my-4">
                    <div class="col-12 cont-pagination d-flex justify-content-center">
                        {{ $destinationposts->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                </div> --}}

            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>

    </main>
@endsection
