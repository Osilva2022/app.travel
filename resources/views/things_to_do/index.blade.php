@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            @include('menus.sub_menu_destinations')
           
            @if (isset($destination[0]))               
            
            <div class="bg-light hero-image" style="background-image: url({{ $destination[0]->image }})">
                <section class="py-5 text-center container">
                    <div class="row py-lg-5">
                        <div class="col-lg-6 col-md-8 mx-auto text-white">
                            <h1>Things To do in {{ $destination[0]->name }}</h1>
                            <p class="lead">
                                Something short and leading about the collection below—its contents, the
                                creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                                entirely.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
            @endif
    
            <br>

            <div class="row text-center justify-content-center">
                <div class="col-12">                    
                    
                    <div class="col-12">
                        <div class="row justify-content-center">                            
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
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
