@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    Cont1
                </div>
                <div class="col-4 col-lg-4">
                    Cont2
                </div>
            </div>
        </div>
    </main>
@endsection
