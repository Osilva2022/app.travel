@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ $destination_data[0]->image }})">
            <section class="py-5 text-start container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto text-white">
                        <h1>{{ $destination_data[0]->name }}</h1>
                        <p class="lead">
                            Something short and leading about the collection below—its contents, the
                            creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                            entirely.
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <div class="cont-menu-destination" style="overflow-x: auto; height: 60px;">
                        <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist"
                            style="min-width: 678px;">
                            @foreach ($destinations_data as $data)
                                <li class="nav-item nav-test mx-1" role="presentation">
                                    <a class="nav-link" id="{{ $data->slug }}-tab"
                                        href="{{ url("$category") }}?destination={{ $data->slug }}" type="button">
                                        <small>{{ $data->name }}</small></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Puerto Vallarta Activities</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                @foreach ($things_categories as $tc)
                    <div class="col">
                        <div class="card border-0">
                            <img src="{{$tc->image}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">{{$tc->category}}</h3>
                                <p class="card-text">Lorem ipsum dolor sit amet, 
                                    consetetur sadipscing elitr, sed diam 
                                    nonumy eirmod tempor invidunt ut 
                                    labore.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
