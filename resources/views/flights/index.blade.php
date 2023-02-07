@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 90px;" class="h-100">
        <div class="container" style="max-width: 1024px;">
            <div class="row mb-4">
                <div class="col">
                    <div class="cont-menu-destination" style="overflow-x: auto; padding-bottom: 8px;">
                        <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist"
                            style="min-width: 678px;">
                            <li class="nav-item nav-test mx-1" role="presentation">
                                <a class="nav-link {{ $destination == 'cancun' ? 'active' : '' }}" id="cancun-tab"
                                    href="{{ route('flights', 'cancun') }}" type="button">
                                    <small>Cancun</small>
                                </a>
                            </li>
                            <li class="nav-item nav-test mx-1" role="presentation">
                                <a class="nav-link {{ $destination == 'los-cabos' ? 'active' : '' }}" id="los-cabos-tab"
                                    href="{{ route('flights', 'los-cabos') }}" type="button">
                                    <small>Los Cabos</small>
                                </a>
                            </li>
                            <li class="nav-item nav-test mx-1" role="presentation">
                                <a class="nav-link {{ $destination == 'puerto-vallarta' ? 'active' : '' }}"
                                    id="puerto-vallarta-tab" href="{{ route('flights', 'puerto-vallarta') }}"
                                    type="button">
                                    <small>Puerto Vallarta</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <iframe id="myiFrame" title="Flights" width="100%" height="1024px" src="{!! $iframe !!}"
                        class="" frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p style="text-align: end;">By avionio.com</p>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('jquery')
    <script>
        // $('#myiFrame').load(function() {
        //     $(this).contents().find(".timetable-flight").css({
        //         'pointer-events': 'none'
        //     });
        // });
    </script>
@endsection
