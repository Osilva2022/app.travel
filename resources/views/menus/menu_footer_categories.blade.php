            <!-- BOTONES CATEGORIAS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
            <div class="row row-cols-3 g-4 p-4 justify-content-center">
                <div class="col-md-3 col-lg-2 text-center">
                    @php
                        $x = '';
                        if (isset($destination) && $destination != '') {
                            $x = '?destination=' . $destination;
                        }
                    @endphp
                    <a href="{{ route('guide') }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-geo-alt" style="font-size: 2.5rem;"></i>
                            <h5>Guide</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['reviews']) }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-clipboard-check" style="font-size: 2.5rem;"></i>
                            <h5>Reviews</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['news']) }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-newspaper" style="font-size: 2.5rem;"></i>
                            <h5>News</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['things-to-do']) }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-bag-check" style="font-size: 2.5rem;"></i>
                            <h5>Things to Do</h5>
                        </button>
                    </a>
                </div>
                {{-- <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('events') }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-calendar-event" style="font-size: 2.5rem;"></i>
                            <h5>Events</h5>
                        </button>
                    </a>
                </div> --}}
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category', ['blogs']) }}{{ $x }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <i class="bi bi-book" style="font-size: 2.5rem;"></i>
                            <h5>Blogs</h5>
                        </button>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
