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
                <div class="col col-md-4 col-lg-6">
                    <span class="badge etiqueta-categoria"
                        style="background-color:blue">{{ $events[0]->_embedded->{'wp:term'}[1][0]->name }}</span>
                    <span class="badge etiqueta-categoria" style="background-color:blue"></span>
                </div>
                <div class="col-auto col-md-3 col-lg-2">
                    Share:
                    <a rel="nofollow" class="fb-btn" href="javascript: void(0)"
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ route('event', [$destination, $slug]) }}','sharer','toolbar=0,status=0,width=548,height=325');">
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('events', ['destination' => $destination]) }}">{!! $category !!}</a>
                            </li>
                            <li class="breadcrumb-item fw-bold" aria-current="page">{!! $events[0]->title->rendered !!}</li>
                        </ol>
                    </nav>
                </div>
                <!-- MENU RUTA -->
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-8 g-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <img src="{!! $events[0]->_embedded->{'wp:featuredmedia'}[0]->source_url !!}" class="card-img-final">
                        </div>
                        @php
                            $date = strtotime($events[0]->meta->_EventStartDate);
                            $date2 = strtotime($events[0]->meta->_EventStartDate);
                        @endphp
                        <div class="col-12">
                            <h1>{!! $events[0]->title->rendered !!}, {!! date('M', $date) !!} {!! date('d', $date) !!}</h1>
                        </div>
                        <!-- POST / NOTA -->
                        <div class="col-12 px-4 post-cont">

                            {!! $events[0]->content->rendered !!}
                        </div>
                        @php
                            $startDate = date('Ymd', strtotime($events[0]->meta->_EventStartDate));
                            $startTime = date('His', strtotime($events[0]->meta->_EventStartDate));
                            $endDate = date('Ymd', strtotime($events[0]->meta->_EventEndDate));
                            $endTime = date('His', strtotime($events[0]->meta->_EventEndDate));
                            $allday = $events[0]->meta->_EventAllDay;
                            
                            $dates = urldecode($startDate) . 'T' . urldecode($startTime) . '/' . urldecode($endDate) . 'T' . urldecode($endTime);
                            if ($allday != null) {
                                $dates = urldecode($startDate) . '/' . urldecode($endDate);
                            }
                            
                        @endphp
                        <div class="col-12 mt-2">
                            <a target="_blank" class="btn btn-outline-primary d-block"
                                href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates={{ $dates }}&timeZone=America/Mexico_City&location={{ $events[0]->_embedded->{'wp:term'}[1][0]->slug }}&text={{ $events[0]->title->rendered }}&details={{ $events[0]->content->rendered  }}">
                                <i class="bi bi-calendar"></i> Add to Calendar
                            </a>
                        </div>
                        <!-- POST / NOTA -->
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
                                    <h2 class="mb-0">More {!! $category !!}</h2>
                                    @foreach ($more_events as $data)
                                        <div class="col">
                                            <div class="card card-secundario">
                                                <div class="row">
                                                    <div class="col card-head-secundario">
                                                        <a
                                                            href="{{ route('event', ['destination' => $data->destination_slug, 'slug' => $data->slug]) }}">
                                                            <img {!! img_meta($data->image_data) !!} class="card-img-secundario">
                                                        </a>
                                                    </div>
                                                    <div class="col-6 card-body-secundario">
                                                        @php
                                                            $date = strtotime($data->start_date);
                                                            $date2 = strtotime($data->end_date);
                                                        @endphp
                                                        <a
                                                            href="{{ route('event', ['destination' => $data->destination_slug, 'slug' => $data->slug]) }}">
                                                            <h3 class="card-title-secundario">{!! $data->title !!}</h3>
                                                        </a>
                                                        <h2 class="align-middle">{!! date('M', $date) !!}</h2>
                                                        <h2 class="align-middle">{!! date('d', $date) !!}</h2>
                                                        @php
                                                            $startDate = date('Ymd', strtotime($data->start_date));
                                                            $startTime = date('His', strtotime($data->start_date));
                                                            $endDate = date('Ymd', strtotime($data->end_date));
                                                            $endTime = date('His', strtotime($data->end_date));
                                                            $allday = $data->all_day;
                                                            
                                                            $dates = urldecode($startDate) . 'T' . urldecode($startTime) . '/' . urldecode($endDate) . 'T' . urldecode($endTime);
                                                            if ($allday != null) {
                                                                $dates = urldecode($startDate) . '/' . urldecode($endDate);
                                                            }
                                                            
                                                        @endphp
                                                    </div>
                                                    <div class="col-12">

                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <a target="_blank" class="btn btn-outline-primary d-block"
                                                            href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates={{ $dates }}&timeZone=America/Mexico_City&location={{ $data->destination }}&text={{ $data->title }}&details={{ $data->content }}">
                                                            <i class="bi bi-calendar"></i> Add to Calendar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col text-center">
                                        <a href="{{ route('events') }}" class="btn-view-more" type="button">More
                                            {!! $category !!}</a>
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
                        <i class="bi bi-arrow-left-circle"></i> Prev Event
                    </span>
                    <a
                        href="{{ route('event', ['destination' => $more_events[0]->destination_slug, 'slug' => $more_events[0]->slug]) }}">
                        <h3 class="card-title-secundario">{!! $more_events[0]->title !!}</h3>
                    </a>
                </div>
                <div class="col text-end">
                    <span class="text-muted">
                        Next Event <i class="bi bi-arrow-right-circle"></i>
                    </span>
                    <a
                        href="{{ route('event', ['destination' => $more_events[1]->destination_slug, 'slug' => $more_events[1]->slug]) }}">
                        <h3 class="card-title-secundario">{!! $more_events[1]->title !!}</h3>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORÍAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORÍAS -->
        </div>
    </main>
@endsection
