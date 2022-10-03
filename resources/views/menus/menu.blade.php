<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top header" id="menu-header">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/tribune-white.svg" width="125"
                height="35" class="d-inline-block align-top" alt="Tribune Travel">
        </a>
        <button class="navbar-toggler btn-menu-border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav mt-2 mt-md-0 ps-4 ps-md-0">
                @foreach ($categories_data as $cd)
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('category', ["$cd->slug"]) }}">{{ $cd->name }}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('guide') }}">Guide</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('events') }}">Events</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="destination-dropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Destinations
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="destination-dropdown">
                        @foreach ($destinations as $dd)
                            <li>
                                <a class="dropdown-item text-white"
                                    href="{{ route('destinations', ["$dd->slug"]) }}">{!! $dd->name !!}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="bi bi-search" data-bs-toggle="modal"
                            data-bs-target="#srcModal"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- MENU -->
