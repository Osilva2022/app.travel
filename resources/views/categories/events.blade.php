@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            @include('menus.sub_menu_destinations')
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Calendar</h2>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum quidem temporibus sint atque non
                    eligendi molestiae alias reprehenderit, magnam aliquid, id minima corporis amet aut! Non harum velit
                    numquam error?
                </div>
            </div>
            <h2>Featured Events</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 ">
                @foreach ($events as $event)
                    <div class="col px-4">
                        <div class="row">
                            <div class="col-12 text-center  mb-2" style="height: 40vh;">
                                <img src="{{ $event->image }}" class="bd-placeholder-img-lg img-fluid mb-3"
                                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"
                                    style=" width: 100%; height: 100%; vertical-align: middle;">
                            </div>
                            <div class="col-12 mb-1">
                                <div class="row">
                                    <div class="col-2 border-end border-primary text-center border-3 py-0">
                                        @php
                                            $date = strtotime($event->start_date);
                                            $date2 = strtotime($event->end_date);
                                        @endphp
                                        <h3 class="align-middle">{{ date('M', $date) }}</h3>
                                        <h3 class="align-middle"><b>{{ date('d', $date) }}</b></h3>
                                    </div>
                                    <div class="col-10 py-0 text-start">
                                        <h3>{{ $event->title }}</h3>
                                        <b>{{ date('M d, Y', $date) }}</b> - <b>{{ date('M d, Y', $date2) }}</b><br>
                                        {{ $event->destination }}<br>
                                        <small>
                                            {{ $event->category }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus, qui id. Tenetur rerum,
                                    suscipit ratione incidunt quia hic. Temporibus cumque dolorem voluptatibus earum, sequi
                                    facere eveniet ex rem nobis? Rerum.</p>
                            </div>
                        </div>
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
