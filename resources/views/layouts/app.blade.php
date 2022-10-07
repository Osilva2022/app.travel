<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="msvalidate.01" content="8FA114FA6F4F1BFE15936EB27C738AAE" />
    {!! SEO::generate() !!}
    {{-- <title>@yield('page-title')</title> --}}
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/typekit.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('OwlCarousel/dist/assets/owl.theme.default.min.css') }}">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="preload"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="{{ asset('css/base.css?v=' . mt_rand()) }}" rel="stylesheet" media="print" onload="this.media='all'">
    {{-- <link href="{{ asset('css/base.min.css?v=' . mt_rand()) }}" rel="stylesheet" media="print"
        onload="this.media='all'"> --}}
    {{-- <link href="{{ asset('css/carousel.css') }}" rel="preload" as="style"
        onload="this.onload=null;this.rel='stylesheet'"> --}}
    <link href="{{ asset('css/carousel.min.css?v=' . mt_rand()) }}" rel="preload" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script> --}}
    <script src="{{ asset('OwlCarousel/dist/owl.carousel.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity=""
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/carousels.min.js') }}"></script>
    @stack('ads')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N3TCH2W');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="p-0">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N3TCH2W" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    {{-- HEADER & MAIN --}}
    @yield('content')
    {{-- HEADER & MAIN --}}
    <!-- FOOTER -->
    <footer class="pt-4 mt-2 border-top border-4" style="background: #243A85 !important; color:#fff;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-5 justify-content-center g-4 align-items-center">
                <div class="col text-center">
                    <a class="text-muted" href="{{ route('home') }}">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/tribune-white.svg"
                            width="125" height="100" alt="Tribune Travel">
                    </a>
                </div>
                <div class="col text-white text-center" style="font-weight:300;">
                    <a href="{{ route('contact') }}">
                        <h3 class="text-white">Contact Us</h3>
                    </a>
                    <address class="mb-0">
                        <ul class="nav justify-content-center flex-column">
                            <li class="nav-item"><a href="tel:" class="text-white">322 226 3870</a></li>
                            <li class="nav-item"><a href="mailto:" class="text-white">digital@cps.media</a></li>
                        </ul>
                    </address>
                </div>
                <div class="col text-center text-white">
                    <h3 class="text-white text-center" style="padding: 2px;">Social Media</h3>
                    <ul class="nav pb-2 mb-2 justify-content-center">
                        <li class="">
                            <a class="text-muted" href="{{ config('constants.FACEBOOK_URL') }}" target="_blank">
                                <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/face-white-ico.svg"
                                    alt="Tribune Travel facebook-icon" width="24" height="24">
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="text-muted" href="{{ config('constants.PINTEREST_URL') }}" target="_blank">
                                <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/pint-white-ico.svg"
                                    alt="Tribune Travel pint-icon" width="24" height="24">
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="text-muted" href="{{ config('constants.INSTAGRAM_URL') }}" target="_blank">
                                <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/inst-white-ico.svg"
                                    alt="Tribune Travel insta-icon" width="24" height="24">
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="text-muted" href="{{ url('rss') }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff"
                                    class="bi bi-rss" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="M5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-3-8.5a1 1 0 0 1 1-1c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1 6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1-1-1z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col text-md-start text-white text-center">
                    <a class="nav-link text-white" style="padding: 2px;" href="{{ route('sitemap') }}">
                        <h3 class="text-white text-center mb-2">Sitemap <br>
                            <i class="bi bi-diagram-3" style="font-size: 24px;"></i>
                        </h3>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10  pb-2 mb-2">
                    <hr>
                </div>
            </div>
            <div class="row row-cols-4 g-2 g-lg-3 justify-content-center mb-4">
                <div class="col-12 col-footer text-center">
                    <a href="https://cps.media/" target="_blank">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/cps-media-white.svg"
                            class="img-footer" alt="CPS Logo" loading="lazy" decoding="defer" style="width: 25%;">
                    </a>
                </div>
                <div class="col col-footer text-center">
                    <a href="https://tribunadelabahia.com.mx/" target="_blank">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/tribuna-white.svg"
                            class="img-footer" alt="Tribuna Logo" loading="lazy" decoding="defer">
                    </a>
                </div>
                <div class="col col-footer text-center">
                    <a href="https://radiante.fm/" target="_blank">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/radiante-white-horizontal.svg"
                            class="img-footer" alt="Radiante Logo" loading="lazy" decoding="defer">
                    </a>
                </div>
                <div class="col col-footer text-center">
                    <a href="https://tvmar.tv/" target="_blank">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/tv-mar-white.svg"
                            class="img-footer" alt="TVMar Logo" loading="lazy" decoding="defer">
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <div class="row  g-1 justify-content-center text-center">
                        <div class="col-md-3 px-4">
                            <a class="text-white" href="{{ route('privacy') }}" style="text-decoration: none;">
                                Privacy Notice
                            </a>
                        </div>
                        <div class="col-md-3 px-4">
                            <a class="text-white" href="https://cps.media/declaracion-de-accesibilidad"
                                style="text-decoration: none;" target="_blank">
                                Accessibility Notice
                            </a>
                        </div>
                        <div class="col-md-3 px-4">
                            <a class="text-white" href="#" style="text-decoration: none;">
                                Terms and Conditions
                            </a>
                        </div>
                    </div>
                </div>
                <p class="text-center text-white" style="font-size: 11px;">&copy; {{ date('Y') }} CPS Media. All
                    rights reserved
                </p>
            </div>
        </div>

    </footer>
    <div class="modal fade" id="srcModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-floating" method="GET" action="{{ route('search') }}">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                placeholder="Search this site..." aria-label="Search"
                                aria-describedby="button-addon2" autofocus autocomplete="off">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                        {{-- <input type="search" class="form-control is-invalid" id="txt-src"
                        placeholder="Search this site...">
                    <label for="txt-src">Invalid input</label> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="cajacookies">
        <div class="row">
            <div class="col d-flex flex-column flex-md-row justify-content-around align-items-center">
                <p class="text-center" style="font-size: 12px; margin: 0;">
                    This site uses cookies.
                    If you continue browsing you are giving your consent
                    to accept the <a href="{{ route('cookies') }}">Cookies policy</a> & <a
                        href="{{ route('privacy') }}">Privacy policy</a>.
                </p>
                <a id="btn-cookies" href="javaScript:void(0)" class="btn-view-more"
                    style="font-size: 1rem; width: 100px;">
                    Aceptar</a>
            </div>
        </div>
    </div>

    @yield('jquery')
    <script>
        function loadScript(a) {
            var b = document.getElementsByTagName("head")[0],
                c = document.createElement("script");
            c.type = "text/javascript", c.src = "https://tracker.metricool.com/resources/be.js", c.onreadystatechange = a, c
                .onload = a, b.appendChild(c)
        }
        loadScript(function() {
            beTracker.t({
                hash: "f541338dd90a14125f5c387abad25f12"
            })
        });
    </script>
    <script src="{{ asset('js/base.min.js?v=' . mt_rand()) }}" version="1.1" defer></script>
</body>

</html>
