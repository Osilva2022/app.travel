            <!-- BOTONES CATEGORIAS -->
            <div class="row row-cols-2 g-4 p-4 justify-content-center">
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category',["reviews"]) }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/dest-ico.svg') }}" alt="" width="25%" height="25%">
                            <h5>Reviews</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('category',['news']) }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/news-ico.svg') }}" alt="" width="25%" height="25%">
                            <h5>News</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('guide') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/ttd-ico.svg') }}" alt="" width="25%" height="25%">
                            <h5>Things to Do</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 text-center">
                    <a href="{{ route('events') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/events-ico.svg') }}" alt="" width="25%" height="25%">
                            <h5>Events</h5>
                        </button>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
