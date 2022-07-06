@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row">
                <?php $i = 1; ?>
                @foreach ($postscategory as $data)
                    @php
                        $destination = array_keys($data->terms['post_destinos'])[0];
                        $category = array_keys($data->terms['category'])[0];
                    @endphp
                    @if ($i == 1)
                        <div class="col-12">
                            <div class="card mb-3 border-0">
                                <div class="card border-0">
                                    <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more"
                                        class="text-decoration-none text-muted">
                                        <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow hover-zoom"
                                            style="height: auto; max-height: 400px; width: 100%; display: block;"
                                            id="img-review">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" style="bottom: 1.5rem;">
                                        {{ $data->title }}
                                    </h5>
                                    <p class="card-text">
                                        <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more"
                                            class="text-decoration-none text-muted">
                                            {!! Str::limit(strip_tags($data->excerpt), 225, ' ...') !!}
                                        </a>
                                    </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ $data->post_date->format('d M Y') }}</small></p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach
                <div class="col-12">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @php
                                $destination = array_keys($data->terms['post_destinos'])[0];
                                $category = array_keys($data->terms['category'])[0];
                            @endphp
                            @if ($i >= 2 && $i <= 5)
                                <div class="col-12 col-lg-3">
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-6 col-lg-12 order-lg-2">
                                                <div class="card-body py-3 px-1">
                                                    <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more"
                                                        class="text-decoration-none text-muted">
                                                        <h5 class="card-title">{{ $data->title }}
                                                        </h5>
                                                    </a>
                                                    <p class="card-text"><small
                                                            class="text-muted">{{ $data->post_date->format('d M Y') }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-12 order-lg-1">
                                                <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more">
                                                    <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow"
                                                        style="height: 120px; width: 100%; display: block;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                <h4 class="my-4">Tribune News</h4>
                <div class="col-12">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($postscategory as $data)
                            @php
                                $destination = array_keys($data->terms['post_destinos'])[0];
                                $category = array_keys($data->terms['category'])[0];
                            @endphp
                            @if ($i >= 6)
                                <div class="col-6 col-lg-3">
                                    <div class="card mb-3 border-0">
                                        <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more">
                                            <img src="{{ $data->image }}" class="img-fluid shadow"
                                                style="height: 150px; width: 100%; display: block;">
                                        </a>
                                        <div class="card-body">
                                            <a href="{{ url("$destination/$category/$data->slug") }}" title="Click to see more"
                                                class="text-decoration-none text-muted">
                                                <h5 class="card-title">{{ $data->title }}
                                                </h5>
                                            </a>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ $data->post_date->format('d M Y') }}</small>
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
                    {{ $postscategory->links() }}
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection