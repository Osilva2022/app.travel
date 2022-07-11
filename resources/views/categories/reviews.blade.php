@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <div class="container">
            <div class="row">
                <h2>Tribune Reviews</h2>
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
                                    <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow hover-zoom"
                                        style="height: auto; max-height: 400px; width: 100%; display: block;" id="img-review">
                                    <a href="{{ url("$destination/$category/post/$data->slug") }}" title="Click to see more"
                                        class="text-decoration-none text-muted">
                                        <div class="card-img-overlay text-white h-100">
                                            @foreach ($destinations_data as $dd)
                                                @if (array_values($data->terms['post_destinos'])[0] == $dd->name)
                                                    <a href="{{ route('destinations', ["$dd->slug"]) }}">
                                                        <span class="badge"
                                                            style="background:{{ $dd->meta_value }};">{{ $dd->name }}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                            @if ($firstpostcategory->ID == $data->ID)
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
                                        <a href="{{ url("$destination/$category/post/$data->slug") }}"
                                            title="Click to see more" class="text-decoration-none text-muted">
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
                <div class="col-lg-6 col-lg-12">
                    <div class="col-12">
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach ($postscategory as $data)
                                @php
                                    $destination = array_keys($data->terms['post_destinos'])[0];
                                    $category = array_keys($data->terms['category'])[0];
                                @endphp
                                @if ($i >= 2 && $i <= 5)
                                    <div class="col-6 col-lg-3">
                                        <div class="card mb-3 border-0">
                                            <div class="row g-0">
                                                <div class="card m-0 p-0 border-0">
                                                    <a href="{{ url("$destination/$category/post/$data->slug") }}"
                                                        title="Click to see more">
                                                        <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow"
                                                            style="height: 150px; width: 100%; display: block;">
                                                    </a>
                                                    <div class="card-img-overlay text-white h-100">
                                                        @foreach ($destinations_data as $dd)
                                                            @if (array_values($data->terms['post_destinos'])[0] == $dd->name)
                                                                <a href="{{ route('destinations', ["$dd->slug"]) }}">
                                                                    <span class="badge"
                                                                        style="background:{{ $dd->meta_value }};">{{ $dd->name }}</span>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ url("$destination/$category/post/$data->slug") }}"
                                                        title="Click to see more" class="text-decoration-none text-muted">
                                                        <h3 class="card-title">{{ $data->title }}
                                                        </h3>
                                                    </a>
                                                    <p class="card-text"><small
                                                            class="text-muted">{{ $data->post_date->format('d M Y') }}</small>
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
                            @php
                                $destination = array_keys($data->terms['post_destinos'])[0];
                                $category = array_keys($data->terms['category'])[0];
                            @endphp
                            @if ($i >= 6)
                                <div class="col-12 col-lg-4">
                                    <div class="card mb-3 border-0">
                                        <div class="card m-0 p-0 border-0">
                                            <a href="{{ url("$destination/$category/post/$data->slug") }}"
                                                title="Click to see more">
                                                <img src="{{ $data->image }}" class="img-fluid rounded-4 shadow"
                                                    style="height: 250px; width: 100%; display: block;">
                                            </a>
                                            <div class="card-img-overlay text-white h-00">
                                                @foreach ($destinations_data as $dd)
                                                    @if (array_values($data->terms['post_destinos'])[0] == $dd->name)
                                                        <a href="{{ route('destinations', ["$dd->slug"]) }}">
                                                            <span class="badge"
                                                                style="background:{{ $dd->meta_value }};">{{ $dd->name }}</span>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ url("$destination/$category/post/$data->slug") }}"
                                                title="Click to see more" class="text-decoration-none text-muted">
                                                <h3 class="card-title">{{ $data->title }}
                                                </h3>
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
                    {{ $postscategory->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
