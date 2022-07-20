<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="msvalidate.01" content="8FA114FA6F4F1BFE15936EB27C738AAE" />
    <title>Tribune Travel</title>
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    <link rel="stylesheet" href="https://use.typekit.net/qfr3cjd.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/base.js') }}" version="1"></script>
    <script>
        $(function() {
            $(window).on("scroll", function() {
                if ($(window).scrollTop() > 200) {
                    $("#menu-header").addClass("menu-active");

                } else {
                    $("#menu-header").removeClass("menu-active");
                }
            });

            $("#navbar-toggler").click(function(e) {
                $("#menu-header").addClass('menu-active');
            });
        });
    </script>
</head>

<body>
    {{-- HEADER & MAIN --}}
    @yield('content')
    {{-- HEADER & MAIN --}}
    <!-- FOOTER -->
    <footer class="pt-4 mt-2 border-top border-4" style="border-top-color: #243A85 !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center  pb-2 mb-2">
                    <a class="text-muted" href="#">
                        <img src="{{ asset('img/svg/tribune-travel-color.svg') }}" width="125" alt="">
                    </a>
                </div>
                <div class="col-12 text-center">
                    <h5 class="">Contacto</h5>
                    <address>
                        <ul class="nav justify-content-center flex-column">
                            <li class="nav-item px-2">322 226 3870</li>
                            <li class="nav-item px-2">digital@cps.media</li>
                            <li class="nav-item px-2">Proa 111, Marina Vallarta, CP. 48335 Puerto Vallarta, Jalisco
                            </li>
                        </ul>
                    </address>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <ul class="nav pb-2 mb-2 justify-content-center">
                        <li class="">
                            <a class="text-muted" href="https://www.facebook.com/TribuneTravel/">
                                <img src="{{ asset('img/svg/face-ico.svg') }}" alt="facebook-icon" width="24"
                                    height="24">
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="text-muted" href="https://www.youtube.com/channel/UCqHGXwbsSrkAjnr3kVFcOdA"
                                target="_blank">
                                <img src="{{ asset('img/youtube.png') }}" alt="facebook-icon" width="24"
                                    height="24">
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="text-muted" href="https://www.instagram.com/tribunetravel/">
                                <img src="{{ asset('img/svg/inst-ico.svg') }}" alt="facebook-icon" width="24"
                                    height="24">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-10  pb-2 mb-2">
                    <hr>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center  pb-2 mb-2">
                    <a class="" href="#">
                        <img src="{{ asset('img/svg/cps-media-color.svg') }}" width="100" alt="">
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-10 pb-2 mb-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-1 col-3 text-center">
                            <a class="" href="https://tvmar.tv/" target="_blank">
                                <img src="{{ asset('img/svg/tv-mar-black.svg') }}" width="100%" alt="">
                            </a>
                        </div>
                        <div class="col-lg-1 col-3 text-center">
                            <a class="" href="https://radiante.fm/" target="_blank">
                                <img src="{{ asset('img/svg/radiante-fm-horizontal-black.svg') }}" width="100%"
                                    alt="">
                            </a>
                        </div>
                        <div class="col-lg-1 col-3 text-center">
                            <a class="" href="https://tribunadelabahia.com.mx/" target="_blank">
                                <img src="{{ asset('img/svg/tribuna-color.svg') }}" width="100%" alt="">
                            </a>
                        </div>
                        <div class="col-lg-1 col-3 text-center">
                            <a class="" href="#">
                                <img src="{{ asset('img/svg/tribune-travel-black.svg') }}" width="100%"
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <ul class="nav justify-content-center">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Aviso de
                                privacidad</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Políticas de
                                accesibilidad</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Derecho de
                                réplica</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Términos y
                                condiciones</a></li>
                    </ul>
                </div>
                <p class="text-center text-muted mt-4 fs-6">&copy; 2022 CPS Media. Todos Los Derechos Reservados</p>
            </div>
        </div>
    </footer>
</body>

</html>
