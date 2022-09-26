@extends('layouts.app')
@section('page-title')
    Things to Do |
@endsection
@php
$mostrar = true;
@endphp
@if ($mostrar)
    @push('ads')
        <!-- Tribune Top Leaderboard Guide Categories -->
        <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
        <script defer>
            window.googletag = window.googletag || {
                cmd: []
            };
            googletag.cmd.push(function() {
                googletag.defineSlot('/21855382314/tt-guide-categories-lb-1', [
                    [320, 50],
                    [728, 90],
                    [970, 90],
                    [300, 100]
                ], 'div-gpt-ad-1661986700096-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-guide-categories-lb-2', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661986843638-0').addService(googletag.pubads());
                googletag.defineSlot('/21855382314/tt-guide-categories-lb-3', [
                    [728, 90],
                    [320, 50]
                ], 'div-gpt-ad-1661987195459-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
    @endpush
@endif
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 60px;">
        <div class="bg-light hero-image" style="background-image: url({{ imgURL($things_category[0]->image_data) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{!! $things_category[0]->name !!}</h1>
                <h2 {{-- id="t1" --}} class="text-white">{!! $destination_data[0]->name !!}</h2>
                <p class="text-white">
                    {!! $things_category[0]->description !!}
                </p>
            </div>
        </div>
        <div class="container g-4">
            @include('menus.submenu_things')
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-categories-lb-1 -->
                        <div id='div-gpt-ad-1661986700096-0' style='min-width: 300px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661986700096-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
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
                                                <img {!! img_meta($data->image_data) !!} class="carousel-img">
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
            @if ($mostrar)
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-categories-lb-2 -->
                        <div id='div-gpt-ad-1661986843638-0' style='min-width: 320px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661986843638-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            @include('menus.menu_directory')
            <div class="row g-4">
                <div class="col-12 col-md-3">
                    <div class="row" style="top: 7.5rem;">
                        <div class="col">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Tags Filter
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach ($guide_tags as $tag)
                                                <div class="form-check" style="font-size: 14px; font-weight: 300;">
                                                    <input class="form-check-input tag-check" type="checkbox" name="tag[]"
                                                        value="{!! $tag->term_id !!}" id="tag-{!! $tag->term_id !!}">
                                                    <label class="form-check-label" for="tag-{!! $tag->term_id !!}">
                                                        {!! $tag->name !!}
                                                    </label>
                                                </div>
                                                <div class="row"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h3>Tags</h3>
                        <div class="col">
                            @foreach ($guide_tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input tag-check" type="checkbox" name="tag[]"
                                        value="{!! $tag->term_id !!}" id="tag-{!! $tag->term_id !!}">
                                    <label class="form-check-label" for="tag-{!! $tag->term_id !!}">
                                        {!! $tag->name !!}
                                    </label>
                                </div>
                                <div class="row"></div>
                            @endforeach
                        </div> --}}
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row g-4 mb-4" id="guide-container">
                        <div class="col-12" id="msg-container" style="display: none;">
                            <h1 class="text-center mt-4">No Results...</h1>
                        </div>
                        <?php $letra = ''; ?>
                        @foreach ($things as $data)
                            @include('guide.gallery')
                        @endforeach
                    </div>
                </div>
            </div>
            @include('menus.menu_directory')
            @if ($mostrar)
                <div class="row">
                    <div class="col-12 d-flex justify-content-center" style="max-width: 100%; overflow: auto;">
                        <!-- /21855382314/tt-guide-categories-lb-3 -->
                        <div id='div-gpt-ad-1661987195459-0' style='min-width: 320px; min-height: 50px;'>
                            <script>
                                googletag.cmd.push(function() {
                                    googletag.display('div-gpt-ad-1661987195459-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
            <!-- Modal -->
            <div class="modal fade" id="directory-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
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
            <!-- Modal -->
        </div>
        <script defer src="{{ asset('js/submenu_things.js') }}" version="1"></script>
        <script defer src="{{ asset('js/things-directory.js') }}" version="1"></script>
        <script defer>
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

                $(".tag-check").change(function(e) {
                    e.preventDefault();
                    $("#msg-container").hide();
                    let array_tags = $(".tag-check:checked")
                        .map(function() {
                            return this.value;
                        })
                        .get()
                        .join();

                    if (array_tags.trim() == "") {
                        $(".containers-guide").show();
                        return false
                    }
                    $.ajax({
                        type: "get",
                        url: "{{ route('get-posts-tags') }}",
                        data: {
                            tags: array_tags
                        },
                        success: function(data) {
                            console.log(data);
                            $(".containers-guide").hide();
                            if (data != 'xox' && data != "") {
                                let ids = data.split(',');
                                $.each(ids, function(index, value) {
                                    // console.log(value);
                                    $("#container-guide-" + value).show();
                                });
                            } else {
                                $("#msg-container").show();
                            }
                        }
                    });
                });

            });
        </script>
    </main>
@endsection
