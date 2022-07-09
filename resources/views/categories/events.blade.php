@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10">
                    <h3>Calendar</h3>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum quidem temporibus sint atque non eligendi molestiae alias reprehenderit, magnam aliquid, id minima corporis amet aut! Non harum velit numquam error?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem, consectetur quibusdam. Neque tempora illo, aliquam suscipit accusamus, impedit non dolore, nesciunt ipsam doloremque ipsum praesentium eveniet et! Nesciunt, a repellat.
                    <br><br>

                    <h4>Featured Events</h4>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            @foreach ($events as $event)

                            <div class="col-lg-6">
                                <img src="{{ $event->image }}" class="bd-placeholder-img-lg img-fluid mb-3" aria-hidden="true"
                                    preserveAspectRatio="xMidYMid slice" focusable="false" width="300" >
                            </div>

                            <div class="col-lg-6">
                                <div class="col-3 border-end border-primary border-3 text-end py-0 h-50">
                                    @php
                                    $date = strtotime($event->start_event);                                
                                    @endphp
                                    <h3 class="align-middle">{{ date('M',$date) }}</h3>
                                    <h3 class="align-middle"><b>{{ date('d',$date) }}</b></h3>
                                </div>
                                <div class="col-9 py-0">
                                    <h5>{{ $event->title }}</h5>
                                    <p>{{ $event->content }}</p>
                                    <p>{{ date('M d, Y',$date) }}
                                        <br> {{ $event->city }}
                                    </p>
                                </div>
                            </div>                                
                                
                            @endforeach
                        </div>                      
                    </div>                                        
                
                    <div class="maring" style="margin-bottom: 10%"> ...  </div>
                </div>
            </div>
           
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
