@section('content')
    <header>
        @include('posts.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row">
                <h4>Tribune Reviews</h4>
                <div class="col-12">
                    <div class="card mb-3 border-0">
                        <div class="card border-0">
                            <img src="{{ $review->image }}" class="img-fluid rounded-4 shadow hover-zoom"
                                style="height: auto; max-height: 400px; width: 100%; display: block;" id="img-review">
                            <a href="{{ route('posts.show', $review) }}" title="Click to see more"
                                class="text-decoration-none text-muted">
                                <div class="card-img-overlay text-white h-100">
                                    @foreach ($categories as $cat)
                                        @if ($review->main_category == $cat->name)
                                            <span class="badge"
                                                style="background:{{ $cat->meta_value }};">{{ $review->main_category }}</span>
                                        @endif
                                    @endforeach
                                    <span class="badge float-end">
                                        <img src="media/estrella.png" alt="destacada" width="25" height="25">
                                    </span>
                                    <h5 class="card-title position-absolute" style="bottom: 1.5rem;">{{ $review->title }}
                                    </h5>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('posts.show', $review) }}" title="Click to see more"
                                    class="text-decoration-none text-muted">
                                    {!! Str::limit($review->content, 225, ' ...') !!}
                                </a>
                            </p>
                            <p class="card-text"><small
                                    class="text-muted">{{ $review->post_date->format('d M Y') }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-12">
                    <div class="col-12">
                        <div class="row">
                            {{ $i = 1 }}
                            @foreach ($reviews as $data)
                                @if ($review->ID != $data->ID)
                                    @if ($i >= 1 && $i <= 4)
                                        {{ $i++ }}
                                        <div class="col-6 col-lg-3">
                                            <div class="card mb-3 border-0">
                                                <div class="row g-0">
                                                    <a href="{{ route('posts.show', $review) }}"
                                                        title="Click to see more">
                                                        <img src="{{ $review->image }}"
                                                            class="img-fluid rounded-4 shadow"
                                                            style="height: 150px; width: 100%; display: block;">
                                                    </a>
                                                    <div class="card-body">
                                                        <a href="{{ route('posts.show', $review) }}"
                                                            title="Click to see more"
                                                            class="text-decoration-none text-muted">
                                                            <h5 class="card-title">{{ $review->title }}
                                                            </h5>
                                                        </a>
                                                        <p class="card-text"><small
                                                                class="text-muted">{{ $review->post_date->format('d M Y') }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-12">
                    <div class="row">
                        {{ $i = 1 }}
                        @foreach ($reviews as $data)
                            @if ($review->ID != $data->ID)
                                @if ($i >= 5 && $i <= 8)
                                    {{ $i++ }}
                                    <div class="col-12 col-lg-4">
                                        <div class="card mb-3 border-0">
                                            <a href="{{ route('posts.show', $review) }}" title="Click to see more">
                                                <img src="{{ $review->image }}" class="img-fluid rounded-4 shadow"
                                                    style="height: 250px; width: 100%; display: block;">
                                            </a>
                                            <div class="card-body">
                                                <a href="{{ route('posts.show', $review) }}" title="Click to see more"
                                                    class="text-decoration-none text-muted">
                                                    <h5 class="card-title">{{ $review->title }}
                                                    </h5>
                                                </a>
                                                <p class="card-text"><small
                                                        class="text-muted">{{ $review->post_date->format('d M Y') }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    {{ $reviews->links() }}
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            <div class="row mb-4">
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="media/svg/ttd-ico.svg" alt="" width="35" height="35">
                        <h5>Things to Do</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="media/svg/events-ico.svg" alt="" width="35" height="35">
                        <h5>Events</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="media/svg/news-ico.svg" alt="" width="35" height="35">
                        <h5>News</h5>
                    </button>
                </div>
                <div class="col-md-3 col-6 text-center mb-4">
                    <button class="text-center rounded-4 shadow btn-square btn" type="button">
                        <img src="media/svg/dest-ico.svg" alt="" width="35" height="35">
                        <h5>Destination</h5>
                    </button>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
