@extends('layouts.app')
@section('page-title')
    Events |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.8rem;">
        <div class="container">
            @include('menus.sub_menu_events')
            <div class="row mb-4">
                <div class="col-12">
                    <h1>Calendar</h1>
                    <p>Looking for what to do in Mexico’s top beach destinations? <br>
                        We got you covered with the best events. Find out what to do and where to go here.</p>
                </div>
            </div>
            <h3>Featured Events</h3>
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4 my-4">
                @foreach ($events as $event)
                    <div class="col">
                        <div class="card-event">
                            <div class="row g-4 position-relative">
                                <a class="link-absolute "
                                    href="{{ route('event', ['destination' => $event->destination_slug, 'slug' => $event->slug]) }}"></a>
                                <div class="col-12 d-flex align-items-center">
                                    <img {!! img_meta($event->image_data, $event->image_alt) !!} class="card-img-estatica" style="object-fit: contain;">
                                </div>
                                <div class="col-12">
                                    <div class="row g-4">
                                        <div
                                            class="col-4 border-end border-primary text-center border-3 py-0 d-flex flex-column justify-content-center align-items-center">
                                            @php
                                                $date = strtotime($event->start_date);
                                                $date2 = strtotime($event->end_date);
                                            @endphp
                                            <h1 class="align-middle">{!! date('M', $date) !!}</h1>
                                            <h1 class="align-middle">{!! date('d', $date) !!}</h1>
                                        </div>
                                        <div class="col-8 py-0 text-start">

                                            <h3>{!! $event->title !!}</h3>
                                            <b>{{ date('M d, Y', $date) }}</b> - <b>{{ date('M d, Y', $date2) }}</b><br>
                                            {!! $event->destination !!}<br>
                                            <small>
                                                {!! $event->category !!}
                                            </small>
                                        </div>
                                        <!--Gmail Button-->
                                        @php
                                            $startDate = date('Ymd', strtotime($event->start_date));
                                            $startTime = date('His', strtotime($event->start_date));
                                            $endDate = date('Ymd', strtotime($event->end_date));
                                            $endTime = date('His', strtotime($event->end_date));
                                            $allday = $event->all_day;
                                            
                                            $dates = urldecode($startDate) . 'T' . urldecode($startTime) . '/' . urldecode($endDate) . 'T' . urldecode($endTime);
                                            if ($allday != null) {
                                                $dates = urldecode($startDate) . '/' . urldecode($endDate);
                                            }
                                            
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                {{ $events->appends($_GET)->links('pagination::bootstrap-4') }}
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
@section('styles')
    <style>
        .link-absolute::after {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            z-index: 10;
            pointer-events: auto;
            content: '';
        }
    </style>
@endsection
