@extends('layouts.app')
@section('page-title')
News |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container" style="max-width: 1024px;">
            @include('menus.sub_menu_destinations')
            <div class="row g-4">
                <h2 class="">Tribune News</h2>
                <?php $i = 1; ?>
                @foreach ($postscategory as $data)
                    @if ($i == 1)
                        <div class="col-12">
                            <div class="card card-principal-post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card border-0">
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                            </a>
                                            <a href="{{ url("$data->url") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                <div class="opacity-effect" style="border-radius: 1rem"></div>
                                                <img src="{{ images($data->image) }}" class="img-category-principal"
                                                    id="img-review">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <a href="{{ url("$data->url") }}" title="Click to see more"
                                            class="text-decoration-none text-muted">
                                            <div class="card-body">
                                                <h3 class="card-title" style="bottom: 1.5rem;">
                                                    {{ $data->title }}
                                                </h3>
                                                <p class="card-text">
                                                    {!! Str::limit(strip_tags($data->post_excerpt), 225, ' ...') !!}
                                                </p>
                                                <small class="text-muted text-end">
                                                    {{ date('M/d/y', strtotime($data->post_date)) }}
                                                </small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach
                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 2 && $i <= 5)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="{{ url("$data->url") }}" title="Click to see more"
                                                    class="text-decoration-none text-muted">
                                                    <div class="card-body-secundario h-100">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                        <small
                                                            class="text-muted">{{ date('M/d/y', strtotime($data->post_date)) }}</small>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col card-head-secundario">
                                                <div class="card m-0 p-0 border-0">
                                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                        <span class="badge etiqueta-img"
                                                            style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                    </a>
                                                    <a href="{{ url("$data->url") }}" title="Click to see more">
                                                        <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                <h2 class="">More News</h2>
                <div class="col-12">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 6)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card mb-3 border-0">
                                        <div class="card m-0 p-0 border-0">
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                            </a>
                                            <a href="{{ url("$data->url") }}" title="Click to see more">
                                                <img src="{{ images($data->image) }}" class="card-img-secundario"
                                                    style="border-radius: 0%;">
                                            </a>
                                        </div>
                                        <a href="{{ url("$data->url") }}" title="Click to see more"
                                            class="text-decoration-none text-muted">
                                            <div class="card-body">
                                                <h3 class="card-title">{{ $data->title }}
                                                </h3>
                                                <small class="text-muted">
                                                    {{ date('M/d/y', strtotime($data->post_date)) }}
                                                </small>
                                            </div>
                                        </a>
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
                    {{ $postscategory->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
    <script src="{{ asset('js/submenu.js') }}" version="1"></script>
@endsection
