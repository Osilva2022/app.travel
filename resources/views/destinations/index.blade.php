@extends('layouts.app')
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 7rem;">
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Album example</h1>
                    <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                        creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                        entirely.</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Main call to action</a>
                        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($destinationposts as $data)
                        <div class="col">
                            <div class="card shadow-sm" style="height: 400px;">
                                <img src="{{ $data->image }}" class="bd-placeholder-img card-img-top" width="100%"
                                    height="225">
                                <div class="card-img-overlay text-white h-100">
                                    @foreach (array_slice($data->terms['category'], 0, 1) as $category)
                                        @foreach ($category_data as $cd)
                                            @if ($category == $cd->name)
                                                <span class="badge"
                                                    style="background:{{ $cd->meta_value }};">{{ $cd->name }}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->title }}</h5>
                                    <p class="card-text">{{ $data->excerpt }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            @foreach (array_slice($data->terms['tag'], 0, 3) as $tag)
                                                @foreach ($tag_data as $td)
                                                    @if ($tag == $td->name)
                                                        <a href="#" type="button"
                                                            class="btn btn-sm btn-outline-secondary text-light"
                                                            style="background: {{ $td->meta_value }}">{{ $tag }}</a>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
