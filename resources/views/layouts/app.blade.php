<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="msvalidate.01" content="8FA114FA6F4F1BFE15936EB27C738AAE" />
    {!! SEO::generate() !!}
    <title>@yield('page-title') Tribune Travel</title>
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/typekit.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="preload"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="{{ asset('css/base.css?v=' . mt_rand()) }}" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="{{ asset('css/carousel.min.css') }}" rel="preload" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity=""
        crossorigin="anonymous"></script>
    @stack('ads')
</head>

<body class="p-0">
    {{-- HEADER & MAIN --}}
    @yield('content')
    {{-- HEADER & MAIN --}}
    <!-- FOOTER -->
    <footer class="pt-4 mt-2 border-top border-4" style="background: #243A85 !important; color:#fff;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-5 justify-content-center g-4 align-items-center">
                <div class="col text-center">
                    <a class="text-muted" href="#">
                        <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/tribune-white.svg"
                            width="125" height="100" alt="Tribune Travel">
                    </a>
                </div>
                <div class="col text-white text-center" style="font-weight:300;">
                    <h3 class="text-white">Contact Us</h3>
                    <address class="mb-0">
                        <ul class="nav justify-content-center flex-column">
                            <li class="nav-item">322 226 3870</li>
                            <li class="nav-item">digital@cps.media</li>
                            <li class="nav-item">Proa 111, Marina Vallarta, CP. 48335 </li>
                            <li class="nav-item">Puerto Vallarta, Jalisco, México. </li>
                        </ul>
                    </address>
                </div>
                <div class="col text-md-start text-white text-center">
                    <ul class="nav justify-content-center flex-column ">
                        <li class="nav-item">
                            <a class="nav-link text-white" style="padding: 2px;"
                                href="{{ route('category', ['reviews']) }}">
                                <h3 class="text-white text-center fs-6 mb-2">Reviews</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" style="padding: 2px;"
                                href="{{ route('category', ['news']) }}">
                                <h3 class="text-white text-center fs-6 mb-2">News</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" style="padding: 2px;"
                                href="{{ route('category', ['things-to-do']) }}">
                                <h3 class="text-white text-center fs-6 mb-2">Things to do</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" style="padding: 2px;" href="{{ route('guide') }}">
                                <h3 class="text-white text-center fs-6 mb-2">Guide</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" style="padding: 2px;" href="{{ route('events') }}">
                                <h3 class="text-white text-center fs-6 mb-2">Events</h3>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- <div class="col text-center text-white">
                    <label class="text-white">Subscribe</label>
                    <div class="input-group mb-3 justify-content-center">
                        <input type="text" class="form-control" placeholder="example@example.com"
                            aria-label="Recipient's username" aria-describedby="button-addon2" style="max-width: 200px">
                        <button class="btn btn-light" style="color: #243A85" type="button" id="button-addon2"><i
                                class="bi bi-send"></i></button>
                    </div>
                </div> --}}
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
                    </ul>
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
                            <a class="text-white" href="https://cps.media/aviso-de-privacidad"
                                style="text-decoration: none;" target="_blank">
                                Notice of Privacy
                            </a>
                        </div>
                        <div class="col-md-3 px-4">
                            <a class="text-white" href="https://cps.media/declaracion-de-accesibilidad"
                                style="text-decoration: none;" target="_blank">
                                Accessibility Policies
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
    <div id="cajacookies">
        <div class="row">
            <div class="col d-flex flex-column flex-md-row justify-content-around align-items-center">
                <p class="text-center" style="font-size: 12px; margin: 0;">
                    This site uses cookies.
                    If you continue browsing you are giving your consent
                    to accept the <a href="{{ route('cookies') }}">Cookies policy</a> & <a
                        href="{{ route('privacy') }}">Privacy policy</a>.
                </p>
                <button onclick="aceptarCookies()" class="btn-view-more" style="font-size: 1rem; width: 100px;">
                    Aceptar</button>
            </div>
        </div>
    </div>

    @yield('jquery')
    <script src="{{ asset('js/carousels.min.js') }}" version="1"></script>
    <script src="{{ asset('js/base.min.js') }}" version="1"></script>
</body>

</html>
