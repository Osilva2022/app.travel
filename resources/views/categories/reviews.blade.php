@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container" style="max-width: 1024px;">
            @include('menus.sub_menu_destinations')
            <div class="row g-4">
                <h2>Tribune Reviews</h2>
                <?php $i = 1; ?>
                @foreach ($postscategory as $data)
                    @if ($i == 1)
                        <div class="col-12">
                            <div class="card card-principal-post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card border-0">
                                            <div class="opacity-effect" style="border-radius: 1rem"></div>
                                            <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                <span class="badge etiqueta-img"
                                                    style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                            </a>
                                            <a href="{{ url("$data->url") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                @if ($firstpostcategory->id_post == $data->id_post)
                                                    <span class="badge etiqueta-destacado">
                                                        <img src="{{ asset('img/estrella.png') }}" alt="destacada"
                                                            width="25" height="25">
                                                    </span>
                                                @endif
                                                <img src="{{ images($data->image) }}" alt="{{ $data->title }}"
                                                    class="img-category-principal">
                                                <h3 class="card-title-overlay">
                                                    {{ $data->title }}
                                                </h3>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <a href="{{ url("$data->url") }}" title="Click to see more"
                                            class="text-decoration-none">
                                            <div class="card-body">
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
                    <div class="row row-cols-2 row-cols-lg-4 g-3">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 2 && $i <= 5)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <div class="row g-0">
                                            <div class="col-12 col-sm-6 col-lg-12">
                                                    <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                                        <span class="badge etiqueta-img"
                                                            style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                                    </a>
                                                    <a href="{{ url("$data->url") }}" title="Click to see more">
                                                        <img src="{{ images($data->image) }}" class="card-img-secundario">
                                                    </a>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-12">
                                                <div class="card-body-secundario h-100">
                                                    <a href="{{ url("$data->url") }}" title="Click to see more"
                                                        class="text-decoration-none text-muted">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                    </a>
                                                    <small class="text-muted">
                                                        {{ date('M/d/y', strtotime($data->post_date)) }}
                                                    </small>
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
                <div class="col-lg-12">
                    <div class="row row-cols-xs-1 row-cols-md-3 g-3">
                        <?php $i = 1; ?>
                        <?php /* var_dump($postscategory[0]["title"]); */ ?>
                        @foreach ($postscategory as $data)
                            @if ($i >= 6)
                                <div class="col">
                                    <div class="card card-secundario h-100">
                                        <a href="{{ route('destinations', ["$data->destination_slug"]) }}">
                                            <span class="badge etiqueta-img"
                                                style="background:{{ $data->destination_color }};">{{ $data->destination }}</span>
                                        </a>
                                        <div class="card m-0 p-0 border-0">
                                            <a href="{{ url("$data->url") }}" title="Click to see more">
                                                <img src="{{ images($data->image) }}" class="img-category-principal">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ url("$data->url") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                <h3 class="card-title">{{ $data->title }}
                                                </h3>
                                            </a>
                                            <p class="card-text">
                                            <small class="text-muted">   
                                                {{ date('M/d/y', strtotime($data->post_date)) }}
                                            </small>
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
            <div class="row my-4">
                <div class="col-12 cont-pagination d-flex justify-content-center">
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
