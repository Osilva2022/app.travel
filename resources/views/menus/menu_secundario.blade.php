<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top header py-4 menu-active" id="menu-secundario"
    style="margin-bottom: 7rem">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/svg/tribune-travel-white.svg') }}" width="100" class="d-inline-block align-top"
                alt="">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="destination-dropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Destination
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="destination-dropdown">
                        @foreach ($destinations_data as $dd)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('destinations', ["$dd->slug"]) }}">{{ $dd->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categories-dropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categories-dropdown">
                        @foreach ($categories_data as $cd)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('category', ["$cd->slug"]) }}">{{ $cd->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('things') }}">Things to Do</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events') }}">Events</a>
                </li>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
<!-- MENU -->
