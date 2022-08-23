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
                                    @foreach ($things_vip as $data)
                                        <a class="item-directory" data-id="{!! $data->ID !!}">
                                            <div class="ttd-slider-item">
                                                <div class="opacity-effect" style="border-radius: 1rem"></div>
                                                <img src="{!! images($data->image) !!}" alt="{!! $data->post_title !!}"
                                                    class="carousel-img">
                                                <div class="container">
                                                    <div class="carousel-info" style="bottom:4px; z-index:2;">
                                                        <h4>{{ $data->post_title }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
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
                        @include('guide.gallery')
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                {{ $things->links('pagination::bootstrap-4') }}
            </div>
            <!-- Modal -->
            <div class="modal fade" id="directory-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Top {!! $things_category[0]->name !!} <i
                                    class="bi bi-stars"></i></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col directory-item-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/submenu_things.js') }}" version="1"></script>
        <script src="{{ asset('js/things-directory.js') }}" version="1"></script>
        <script>
            $(document).ready(function() {
                function getUrlParameter(sParam) {
                    var sPageURL = window.location.search.substring(1),
                        sURLVariables = sPageURL.split('&'),
                        sParameterName,
                        i;

                    for (i = 0; i < sURLVariables.length; i++) {
                        sParameterName = sURLVariables[i].split('=');

                        if (sParameterName[0] === sParam) {
                            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                        }
                    }
                    return false;
                };

                if (getUrlParameter('p')) {
                    console.log(getUrlParameter('p'));
                    CargarDatosModal(getUrlParameter('p'));
                }

                function CargarDatosModal(id) {
                    $('#directory-modal').modal('show');
                    $.ajax({
                        type: "get",
                        url: "{{ route('directory-item') }}",
                        data: {
                            id: id
                        },
                        beforeSend: function() {
                            $('.directory-item-body').html(
                                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"> Loading... </span></div></div>'
                            );
                        },
                        success: function(msg) {
                            $('.directory-item-body').html(msg);
                        }
                    });
                }

                $(".item-directory").click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    CargarDatosModal(id);
                });
            });
        </script>
    </main>
@endsection
