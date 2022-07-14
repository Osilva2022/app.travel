@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            @include('menus.sub_menu_destinations')
            <div class="row">
                <h2>Tribune Reviews</h2>
                <?php $i = 1; ?>
                @foreach ($postscategory as $data)
                    @if ($i == 1)
                        <div class="col-12">
                            <div class="card mb-3 border-0">
                                <div class="card border-0">
                                    <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow hover-zoom"
                                        style="height: auto; max-height: 400px; width: 100%; display: block;" id="img-review">
                                    <a href="{{ url("$data->url") }}" title="Click to see more"
                                        class="text-decoration-none text-muted">
                                        <div class="card-img-overlay text-white h-100">
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="badge"
                                                    style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                            </a>
                                            @if ($firstpostcategory->id_post == $data->id_post)
                                                <span class="badge float-end">
                                                    <img src="{{ asset('img/estrella.png') }}" alt="destacada"
                                                        width="25" height="25">
                                                </span>
                                            @endif
                                            <h3 class="card-title position-absolute" style="bottom: 1.5rem;">
                                                {{ $data->title }}
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <a href="{{ url("$data->url") }}" title="Click to see more"
                                            class="text-decoration-none text-muted">
                                            {!! Str::limit(strip_tags($data->post_excerpt), 225, ' ...') !!}
                                        </a>
                                    </p>
                                    <p class="card-text"><small class="text-muted">{{ $data->post_date }}</small></p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach
                <div class="col-lg-6 col-lg-12">
                    <div class="col-12">
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach ($postscategory as $data)
                                @if ($i >= 2 && $i <= 5)
                                    <div class="col-6 col-lg-3">
                                        <div class="card mb-3 border-0">
                                            <div class="row g-0">
                                                <div class="card m-0 p-0 border-0">
                                                    <a href="{{ url("$data->url") }}" title="Click to see more">
                                                        <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow"
                                                            style="height: 150px; width: 100%; display: block;">
                                                    </a>
                                                    <div class="card-img-overlay text-white h-100">
                                                        <a
                                                            href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                            <span class="badge"
                                                                style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ url("$data->url") }}" title="Click to see more"
                                                        class="text-decoration-none text-muted">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                    </a>
                                                    <p class="card-text"><small
                                                            class="text-muted">{{ $data->post_date }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-12">
                    <div class="row">
                        <?php $i = 1; ?>
                        <?php /* var_dump($postscategory[0]["title"]); */ ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 6)
                                <div class="col-12 col-lg-4">
                                    <div class="card mb-3 border-0">
                                        <div class="card m-0 p-0 border-0">
                                            <a href="{{ url("$data->url") }}" title="Click to see more">
                                                <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow"
                                                    style="height: 250px; width: 100%; display: block;">
                                            </a>
                                            <div class="card-img-overlay text-white h-00">
                                                <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                    <span class="badge"
                                                        style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ url("$data->url") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                <h3 class="card-title">{{ $data->title }}
                                                </h3>
                                            </a>
                                            <p class="card-text"><small class="text-muted">{{ $data->post_date }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 cont-pagination text-center">
                    {{ $postscategory->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
