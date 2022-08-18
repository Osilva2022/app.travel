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
                <h1 id="t1" class="text-white">{!! $things_category[0]->name !!}</h1>
                <h2 {{-- id="t1" --}} class="text-white">{!! $destination_data[0]->name !!}</h2>
                <p class="text-white">
                    {!! $things_category[0]->description !!}
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
                                <h2>Top {!! $things_category[0]->name !!} <i class="bi bi-stars"></i></h2>
                            </div>
                            <div class="col-lg-9">
                                <div class="owl-carousel owl-theme things-vip-carousel" id="">
                                    @foreach ($things_vip as $ttd)
                                        <div class="ttd-slider-item">
                                            <div class="opacity-effect" style="border-radius: 1rem"></div>
                                            <img src="{!! images($ttd->image) !!}" alt="{!! $ttd->post_title !!}"
                                                class="carousel-img">
                                            <div class="container">
                                                <div class="carousel-info" style="bottom:4px; z-index:2;">
                                                    <h4>{{ $ttd->post_title }}</h4>
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
                    <?php $newletra = substr($data->post_title, 0, 1); ?>
                    @if ($newletra != $letra)
                        <?php $letra = $newletra; ?>
                        <div class="col-12">
                            <h2 class="ms-4">{!! $letra !!}</h2>
                            <hr>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card-directory" id="directory-item-{!! $data->ID !!}">
                            <div class="row g-2">
                                {{-- VIP --}}
                                @php
                                    $vip = false;
                                    if ($data->label == 21 || $data->label == 22) {
                                        $vip = true;
                                    }
                                @endphp
                                @if ($vip)
                                    <div class="col-md-4 d-flex justify-content-center position-relative">
                                        <div class="owl-carousel owl-theme directory-carousel dc"
                                            id="dc-{!! $data->ID !!}">
                                            <div class="position-relative">
                                                @if ($data->label == 22)
                                                <span class="etiqueta-vip">
                                                    <i class="bi bi-award"
                                                        style="font-size: 1.5rem; color:white;"></i></span>                                                    
                                                @endif
                                                <img src="{{ images($data->image) }}" class="card-img-estatica">
                                            </div>
                                            @foreach ($gallery['gallery-' . $data->ID] as $img)
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="{{ images($img) }}" class="card-img-slider">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="col">
                                    <div class="row p-4 h-100 g-2">
                                        <div class="col d-flex flex-column">
                                            <h3 class="card-title mb-2">{!! $data->post_title !!}</h3>
                                            <span><i class="bi bi-info-square"></i> {!! $data->post_content !!}</span>
                                            <span><i class="bi bi-geo-alt"></i> {!! $data->address !!}</span>
                                            @if ($vip)
                                                <div id="cont-info-{!! $data->ID !!}"
                                                    class="cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                                                    @if ($data->latitude != '' && $data->longitude != '')
                                                        <span><i class="bi bi-map"></i> <a
                                                                href="https://maps.google.com/?q={!! $data->latitude !!},{!! $data->longitude !!}"
                                                                target="_blank">
                                                                Map View</a></span>
                                                    @endif
                                                    <span><i class="bi bi-telephone"></i><a
                                                            href="tel:{!! $data->phone !!}">
                                                            {!! $data->phone !!}</a></span>
                                                    @if ($data->email)
                                                        <span><i class="bi bi-envelope"></i><a
                                                                href="mailto:{!! $data->email !!}">
                                                                {!! $data->email !!}</a></span>
                                                    @endif
                                                    <div class="d-flex justify-content-around">
                                                        @if ($data->facebook != '')
                                                            <a class="m-2" target="_blank"
                                                                href="{!! $data->facebook !!}">
                                                                <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                                                            </a>
                                                        @endif
                                                        @if ($data->instagram != '')
                                                            <a class="m-2" target="_blank"
                                                                href="{!! $data->instagram !!}">
                                                                <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                                                            </a>
                                                        @endif
                                                        @if ($data->whatsapp != '')
                                                            <a class="m-2" target="_blank"
                                                                href="https://wa.me/{!! $data->whatsapp !!}">
                                                                <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                                                            </a>
                                                        @endif
                                                        @if ($data->website != '')
                                                            <a class="m-2" target="_blank"
                                                                href="{!! $data->website !!}">
                                                                <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($vip)
                                            <div id="cont-info-2-{!! $data->ID !!}"
                                                class="col-md-6 cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                                                <span><i class="bi bi-clock"></i> Work Hours</span>
                                                @php
                                                    $horario = unserialize($data->avaliable);
                                                    $semana = [
                                                        '1' => 'Monday',
                                                        '2' => 'Tuesday',
                                                        '3' => 'Wednesday',
                                                        '4' => 'Thursday',
                                                        '5' => 'Friday',
                                                        '6' => 'Saturday',
                                                        '7' => 'Sunday',
                                                    ];
                                                    /* var_dump($horario[1]); */
                                                @endphp
                                                @for ($i = 1; $i <= 7; $i++)
                                                    @if ($horario[$i]['off'] != 1 && $horario[$i]['hours'] != '')
                                                        <span class="ps-4"
                                                            style="font-size: 14px;">{!! $semana[$i] !!} -
                                                            {!! $horario[$i]['hours'] !!}</span>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div
                                                class="col-12 cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                                                <h4>Owner Message</h4>
                                                {!! $data->remark !!}
                                            </div>
                                            <div class="col-12 d-flex justify-content-end align-items-center">
                                                <button type="button" class="btn btn-info-dir text-white"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target=".cont-info-{!! $data->ID !!}"
                                                    aria-expanded="false"
                                                    aria-controls="cont-info-{!! $data->ID !!} cont-info-2-{!! $data->ID !!}"
                                                    data-id="{!! $data->ID !!}" data-status="0">
                                                    <i class="bi bi-plus-lg"></i> Show More
                                                </button>
                                            </div>
                                        @endif
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
        <script src="{{ asset('js/things-directory.js') }}" version="1"></script>
    </main>
@endsection
