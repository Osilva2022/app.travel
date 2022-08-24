            <!-- BOTONES CATEGORIAS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">  
            <div class="row row-cols-3 g-4 p-4 justify-content-center">
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('home') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-house-door" style="font-size: 2.5rem;"></i>
                            <h5>Home</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('guide') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-geo-alt" style="font-size: 2.5rem;"></i>
                            <h5>Guide</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['reviews']) }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-clipboard-check" style="font-size: 2.5rem;"></i>
                            <h5>Reviews</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['news']) }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-newspaper" style="font-size: 2.5rem;"></i>
                            <h5>News</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('guide') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-bag-check" style="font-size: 2.5rem;"></i>
                            <h5>Things to Do</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('events') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-calendar-event" style="font-size: 2.5rem;"></i>
                            <h5>Events</h5>
                        </button>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
