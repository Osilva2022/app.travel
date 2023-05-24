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
    <main style="margin-top: 90px;">
        <div class="container">
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
                <div class="col-auto col-md-3 col-lg-2">
                    Share:
                    <a rel="nofollow" class="fb-btn" href="javascript: void(0)"
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ route('post_daily', $post_['slug']) }}','sharer','toolbar=0,status=0,width=548,height=325');">
                        <img src="{{ asset('img/svg/face-ico.svg') }}" alt="Tribune Travel facebook-icon" width="17"
                            height="17">
                    </a>
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
                            <li class="breadcrumb-item"><a href="{{ route('category', 'daily-briefing') }}">Daily
                                    Briefing</a></li>
                            <li class="breadcrumb-item fw-bold" aria-current="page">{!! $post_['title'] !!}</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-8 g-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <img {!! img_meta($post_['img']->img_data) !!}" class="card-img-final">
                        </div>
                        <div class="col-12">
                            <h1>{!! $post_['title'] !!}</h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-auto text-end">
                                    <img src="{!! images($post_['author']->avatar) !!}" class="img-fluid rounded-circle"
                                        style="width:56px; height:auto; aspect-ratio:1/1;">
                                </div>
                                <div class="col d-flex flex-column justify-content-center">
                                    <p class="card-title" style="color: #243A85">By
                                        <a href="{{ route('author', $post_['author']->user_nicename) }}">
                                            <b>{!! $post_['author']->name !!}</b>
                                        </a>
                                    </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ date('F d, Y', strtotime($post_['date'])) }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- POST / NOTA -->
                        <div class="col-12 px-4 post-cont">
                            {{-- {!! str_replace(
                                'caption',
                                'div class="sp-caption"',
                                str_replace('[', '<', str_replace(']', '>', $post_['content'])),
                            ) !!} --}}
                            {!! $post_['content'] !!}
                        </div>
                        <!-- POST / NOTA -->
                        @if ($post_['portada_diarios'])
                            <h2 style="margin-bottom: 16px; text-align: center;"><strong>Selected Front Pages</strong></h2>
                            <iframe src="https://docs.google.com/gview?url={!! $post_['portada_diarios'] !!}&embedded=true"
                                frameborder="0" width="100%" height="auto"
                                style="width: 100%; height: auto; aspect-ratio: 1/1; margin-bottom: 40px;"></iframe>
                        @endif
                        <div class="col-12">
                            @foreach ($post_tags as $data)
                                <a href="{{ route('tags', $data->slug) }}">
                                    <span class="badge etiqueta-categoria"
                                        style="background-color: {{ $data->color }}">{!! $data->name !!}</span>
                                </a>
                            @endforeach
                        </div>
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
                                    <h2 class="mb-0">More {!! $post_['category_name'] !!}</h2>
                                    @foreach ($more_posts as $data)
                                        <div class="col">
                                            <div class="card card-secundario">
                                                <div class="row">
                                                    <div class="col card-head-secundario">
                                                        <a href="{{ route('post_daily', $data->slug) }}">
                                                            <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                        </a>
                                                    </div>
                                                    <div class="col-6 card-body-secundario">
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
                                    <div class="col text-center">
                                        <a href="{{ route('post_daily', $data->slug) }}" class="btn-view-more"
                                            type="button">More {!! $post_['category_name'] !!}</a>
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
            <div class="row mb-4">
                <div class="col">
                    <span class="text-muted">
                        <i class="bi bi-arrow-left-circle"></i> Prev Post
                    </span>
                    <a href="{{ route('post_daily', $more_posts[0]->slug) }}">
                        <h3 class="card-title-secundario">{!! $more_posts[0]->title !!}</h3>
                    </a>
                </div>
                <div class="col text-end">
                    <span class="text-muted">
                        Next Post <i class="bi bi-arrow-right-circle"></i>
                    </span>
                    <a href="{{ route('post_daily', $more_posts[1]->slug) }}">
                        <h3 class="card-title-secundario">{!! $more_posts[1]->title !!}</h3>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
