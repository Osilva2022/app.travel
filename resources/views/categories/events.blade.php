@extends('layouts.app')
@section('content')

    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container" style="max-width: 1024px">
            @include('menus.sub_menu_destinations')
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Calendar</h2>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum quidem temporibus sint atque non
                    eligendi molestiae alias reprehenderit, magnam aliquid, id minima
                </div>
            </div>
            <div class="row row-cols-1 g-4 mb-4">
                <h3>Featured Events</h3>
                @foreach ($events as $event)
                    <div class="col">
                        <div class="card-event">
                            <div class="row g-4">
                                <div class="col-md-5 d-flex align-items-center">
                                    <img src="{{ $event->image }}" class="card-img-estatica">
                                </div>
                                <div class="col-md-7">
                                    <div class="row g-4">
                                        <div
                                            class="col-4 border-end border-primary text-center border-3 py-0 d-flex flex-column justify-content-center align-items-center">
                                            @php
                                                $date = strtotime($event->start_date);
                                                $date2 = strtotime($event->end_date);
                                            @endphp
                                            <h1 class="align-middle">{{ date('M', $date) }}</h1>
                                            <h1 class="align-middle">{{ date('d', $date) }}</h1>
                                        </div>
                                        <div class="col-8 py-0 text-start">
                                            <h3>{{ $event->title }}</h3>
                                            <b>{{ date('M d, Y', $date) }}</b> - <b>{{ date('M d, Y', $date2) }}</b><br>
                                            {{ $event->destination }}<br>
                                            <small>
                                                {{ $event->category }}
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <p>{{ $event->content }}</p><br>
                                        </div>
                                        {{-- <div class="col-12 text-end">
                                            <button class="btn btn-success"><i class="bi bi-calendar-plus"></i> Add Google
                                                Calendar</button>
                                        </div> --}}

                                        <!--Gmail Button-->                           

                                        <div class="gmail" style="display: block;">
                                            @php
                                                $startDate = date('Ymd', strtotime($event->start_date));
                                                $startTime = date('His', strtotime($event->start_date));
                                                $endDate = date('Ymd', strtotime($event->end_date));
                                                $endTime = date('His', strtotime($event->end_date));
                                                $dates = urldecode($startDate).'T'.urldecode($startTime).'/'.urldecode($endDate).'T'.urldecode($endTime);
                                            @endphp
                                            <a target="_blank" class="btn btn-warning" href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates={{$dates}}&timeZone=America/Mexico_City&location={{ $event->destination }}&text={{ $event->title }}&details=ok"style="background-color: #F4D66C; font-size: 12px; font-weight:bold; text-decoration: none; padding: 12px 20px; color: #1D2025; border-radius: 5px; display:inline-block; mso-padding-alt:0; box-shadow:0 3px 6px rgba(0,0,0,.2);"><span style="mso-text-raise:15pt;">Add to your Google Calendar</a><br>

                                            {{-- <a rel="noopener" target="_blank" href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates=20220112T180000Z%2F20220112T200000Z&location=PuertoVallarta&details=Descripcion&text=Nombre%20de%20Evento" class="cta btn-yellow" style="background-color: #F4D66C; font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight:bold; text-decoration: none; padding: 12px 20px; color: #1D2025; border-radius: 5px; display:inline-block; mso-padding-alt:0; box-shadow:0 3px 6px rgba(0,0,0,.2);"><span style="mso-text-raise:15pt;">Add to your Google Calendar</span></a> --}}
                   
                                        </div>
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
