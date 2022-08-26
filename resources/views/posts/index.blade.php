@extends('layouts.app')

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

<!-- content -->
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container" style="max-width: 1024px;">
            <div class="row mb-3">
                <div class="col">
                    <!--ads /21855382314/tt-interior-lb-1 -->
                    <div id="div-gpt-ad-1620253079354-0" class="cont-add-banner">
                        <script>
                            googletag.cmd.push(function() {
                                googletag.display('div-gpt-ad-1620253079354-0');
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-4 col-lg-6">
                    <span class="badge etiqueta-categoria"
                        style="background-color: {{ $post->destination_color }}">{{ $post->destination }}</span>
                    {{-- <span class="badge etiqueta-categoria"
                        style="background-color: {{ $post->category_color }}">{{ $post->category }}</span> --}}
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
                    <a class="text-muted" href="{{ config('constants.PINTEREST_URL') }}" target="_blank">
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('category', [$category]) }}">{{ $post->category }}</a></li>
                            <li class="breadcrumb-item fw-bold" aria-current="page">{{ $post->title }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-8 g-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <img {!! img_meta($post->image_data) !!}" class="card-img-final">
                        </div>
                        <div class="col-12 mt-2">
                            {{-- <p class="text-caption">Sunset at Puerto Vallarta | Daniel López</p> --}}
                        </div>
                        <div class="col-12">
                            <h1>{!! $post->title !!}</h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-auto text-end">
                                    <img src="{!! images($post->avatar) !!}" class="img-fluid rounded-circle" width="56"
                                        height="56">
                                </div>
                                <div class="col d-flex flex-column justify-content-center">
                                    <p class="card-title" style="color: #243A85">By
                                        <a href="{{ route('author', $post->user_nicename) }}">
                                            <b>{!! $post->author_name !!}</b>
                                        </a>
                                    </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ date('F d, Y', strtotime($post->post_date)) }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- POST / NOTA -->
                        <div class="col-12 px-4 post-cont">
                            {!! str_replace(
                                'caption',
                                'div class="sp-caption"',
                                str_replace('[', '<', str_replace(']', '>', $post->content)),
                            ) !!}
                        </div>
                        <!-- POST / NOTA -->
                        <div class="col-12 cont-add-banner">
                            <!--ads /21855382314/tt-interior-lb-2 -->
                            <div id="div-gpt-ad-1636587242560-0" class="add-banner text-center">
                                <script>
                                    googletag.cmd.push(function() {
                                        googletag.display('div-gpt-ad-1636587242560-0');
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 g-4">
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <div class="card-more-posts p-4">
                                <div class="row row-cols-1 g-4 pb-4">
                                    <h2 class="mb-0">More {!! $post->category !!}</h2>
                                    @foreach ($more_posts as $data)
                                        <div class="col">
                                            <div class="card card-secundario">
                                                <div class="row">
                                                    <div class="col card-head-secundario">
                                                        <a href="{{ url("$data->url") }}">
                                                            <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                        </a>
                                                    </div>
                                                    <div class="col-6 card-body-secundario">
                                                        <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                            <span class="etiqueta-post mb-2"
                                                                style="background:{{ $data->destination_color }};">
                                                                {!! $data->destination !!}
                                                            </span>
                                                        </a>
                                                        <a href="{{ url("$data->url") }}">
                                                            <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                        </a>
                                                        <small class="text-muted">
                                                            {{ date('M/d/y', strtotime($data->post_date)) }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col">
                                        <a href="{{ route('category', [$post->category_slug]) }}" class="btn-view-more"
                                            type="button">More {!! $post->category !!}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 p-4 px-0 g-4">
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
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
