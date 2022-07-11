            <!-- BOTONES CATEGORIAS -->
            <div class="row mb-4">
                <div class="col-md-3 col-6 text-center mb-4">
                    <a href="{{ route('category', 'reviews') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/dest-ico.svg') }}" alt="" width="35" height="35">
                            <h5>Reviews</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <a href="{{ route('category', 'news') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/news-ico.svg') }}" alt="" width="35" height="35">
                            <h5>News</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <a href="{{ route('things',"puerto-vallarta") }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/ttd-ico.svg') }}" alt="" width="35" height="35">
                            <h5>Things to Do</h5>
                        </button>
                    </a>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <a href="{{ route('events') }}">
                        <button class="text-center rounded-4 shadow btn-square btn" type="button">
                            <img src="{{ asset('img/svg/events-ico.svg') }}" alt="" width="35" height="35">
                            <h5>Events</h5>
                        </button>
                    </a>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
