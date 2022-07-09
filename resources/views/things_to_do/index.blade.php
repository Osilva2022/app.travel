@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10">
                    <h3>Things To do</h3>
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum quidem temporibus sint atque non eligendi molestiae alias reprehenderit, magnam aliquid, id minima corporis amet aut! Non harum velit numquam error?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem, consectetur quibusdam. Neque tempora illo, aliquam suscipit accusamus, impedit non dolore, nesciunt ipsam doloremque ipsum praesentium eveniet et! Nesciunt, a repellat.
                    <br><br>

                   
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
@endsection
