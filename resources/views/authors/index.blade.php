@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="container" style="max-width: 1024px;">
            {{-- @include('menus.sub_menu_destinations') --}}
            <br>
            <div class="row g-4">
                <h2>Tribune Reviews</h2>               
                  
                        <div class="col-12">
                            <div class="card card-principal-post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card border-0">
                                            <a href="">
                                            </a>
                                            <a href="" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                               
                                                <div class="opacity-effect" style="border-radius: 1rem"></div>
                                                <img src="" alt=""
                                                    class="img-category-principal">
                                                <h3 class="card-title-overlay">
                                                   
                                                </h3>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 d-flex align-items-center">
                                        <a href="" title="Click to see more"
                                            class="text-decoration-none">
                                            <div class="card-body">
                                                <p class="card-text">
                                                  
                                                </p>
                                                <small class="text-muted text-end">
                                                    
                                                </small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                 
                
                <div class="col-12">
                    <div class="row row-cols-2 row-cols-lg-4 g-3">
                        
                        @foreach ($destinationposts as $data)
                            
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row g-0">
                                            <div class="col-12 col-sm-6 col-lg-12">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="badge etiqueta-img"
                                                        style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                </a>
                                                <a href="{{ url("$data->url") }}" title="Click to see more">
                                                    <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                </a>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-12">
                                                <div class="card-body-secundario h-100">
                                                    <a href="{{ url("$data->url") }}" title="Click to see more"
                                                        class="text-decoration-none text-muted">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                    </a>
                                                    <small class="text-muted">
                                                        {{ date('M/d/y', strtotime($data->post_date)) }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                        
                        @endforeach
                    </div>
                </div>              

                <div class="row my-4">
                    <div class="col-12 cont-pagination d-flex justify-content-center">
                        {{ $destinationposts->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                <!-- BOTONES CATEGORIAS -->
                @include('menus.menu_footer_categories')
                <!-- BOTONES CATEGORIAS -->
             
            </div>     
      
    </main>
@endsection
