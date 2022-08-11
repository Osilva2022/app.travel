@extends('layouts.app')
@section('page-title')
    Things to Do |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ images($things_category[0]->image) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{{ $things_category[0]->name }}</h1>
                <p class="text-white">
                    {{ $things_category[0]->description }}
                </p>
            </div>
        </div>
        <div class="container" style="max-width: 1024px;">
            @include('menus.submenu_things')
            <div class="row mb-4">
                <div class="col">
                    <div class="card-directory p-4">
                        <div class="row g-2">
                            <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                <h2>Top {{ $things_category[0]->name }} <i class="bi bi-stars"></i></h2>
                            </div>
                            <div class="col-lg-9">
                                <div class="owl-carousel owl-theme things-vip-carousel" id="">
                                    @foreach ($things_vip as $ttd)
                                        <div class="ttd-slider-item">
                                            <div class="opacity-effect" style="border-radius: 1rem"></div>
                                            <img src="{{ images($ttd->image) }}" alt="{{ $ttd->title }}"
                                                class="carousel-img">
                                            <div class="container">
                                                <div class="carousel-info" style="bottom:4px; z-index:2;">
                                                    <h4>{{ $ttd->title }}</h4>
                                                    {{-- <p style="bottom:4px; color: white;">
                                                            {{ $ttd->excerpt }}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <?php $letra = ''; ?>
                @foreach ($things as $data)
                    <?php $newletra = substr($data->title, 0, 1); ?>
                    @if ($newletra != $letra)
                        <?php $letra = $newletra; ?>
                        <div class="col-12">
                            <h2 class="ms-4">{{ $letra }}</h2>
                            <hr>
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="card-directory h-100  p-2">
                            <div class="row g-2">
                                @if ($data->orden == 1 || $data->orden == 2)
                                    {{-- VIP --}}
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <img src="{{ images($data->image) }}" class="card-img-estatica">
                                    </div>
                                @endif
                                <div class="col">
                                    <div class="body-directory h-100">
                                        <h3 class="card-title mb-2">{{ $data->title }}</h3>
                                        <pre class="pre-content">
                                            {!! $data->content !!}
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                {{ $things->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <script src="{{ asset('js/submenu_things.js') }}" version="1"></script>
    </main>
@endsection
