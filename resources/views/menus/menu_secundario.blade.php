<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top header py-4 menu-active" id="menu-secundario" style="margin-bottom: 7rem">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/svg/tribune-travel-white.svg') }}" width="100"
                class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Puerto Vallarta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Riviera Nayarit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Los Cabos</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- MENU -->