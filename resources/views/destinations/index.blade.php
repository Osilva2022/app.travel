@extends('layouts.app')
@section('page-title')
    {!! $destination_data[0]->name !!} |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.2rem;">
        <div class="bg-light hero-image" style="background-image: url({{ imgURL($destination_data[0]->image_data) }})">
            <div class="opacity-effect"></div>
            <div class="info-over text-white">
                <h1 id="t1" class="text-white">{!! $destination_data[0]->name !!}</h1>
                <p class="text-white">
                    {!! $destination_data[0]->description !!}
                </p>
            </div>
        </div>

        <div class="album pb-5 bg-light">
            <div class="container" style="max-width: 1024px;">
                <div class="row mb-4">
                    <div class="col">
                        <div class="" style="overflow-x: auto; height: 60px;">
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="min-width: 678px;">
                                @foreach ($destinations_data as $data)
                                    <li class="nav-item nav-test mx-1" role="presentation">
                                        <a class="nav-link {{ $data->slug == $destination_data[0]->slug ? 'active' : '' }}"
                                            href="{{ route('destinations', $data->slug) }}" type="button">
                                            <small>{!! $data->name !!}</small></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if ($review)
                    <div class="row mb-4">
                        <div class="col">
                            <h2>Reseña</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, amet? Temporibus, ratione
                                cum
                                nihil reprehenderit repudiandae est, quidem hic alias voluptatibus quae dolorum ab iste
                                error!
                                Officia ipsam quam temporibus!Saepe similique eligendi suscipit iure deleniti, earum beatae,
                                non
                                consequuntur reprehenderit, quibusdam molestiae veniam quis at voluptas quas harum
                                accusamus!
                                Molestias perferendis modi repellendus! Nam laborum dicta adipisci. Aliquid, soluta!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo architecto nisi animi odit
                                aut, commodi eligendi minima magnam? Eveniet quo illum quos? Adipisci recusandae officia at
                                non
                                quisquam modi eum?</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit officiis corporis
                                reprehenderit aspernatur sapiente, voluptatem velit neque nesciunt voluptatum quod esse
                                quidem
                                recusandae eaque fugit provident perspiciatis molestias, non ipsum.
                                Quo repudiandae id facilis quia, nobis illo. Odio obcaecati molestiae ipsam deleniti
                                adipisci ea
                                natus asperiores, labore corporis, mollitia veritatis, aut nihil enim nobis iure laudantium
                                dolore voluptate ullam assumenda.
                                Ipsa alias aliquam sit perspiciatis consectetur assumenda et inventore repellat maiores
                                expedita
                                tempore praesentium qui, facere, cupiditate dolor, quae ut? At enim accusamus obcaecati,
                                repudiandae officiis voluptatem laboriosam amet quo!</p>
                        </div>
                    </div>
                @endif
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    @foreach ($destinationposts as $data)
                        <div class="col">
                            <div class="card card-especial zoom">
                                <a href="{{ route('category', $data->category_slug) }}">
                                    <span class="badge etiqueta-img"
                                        style="background:{{ $data->category_color }};">{!! $data->category !!}</span>
                                </a>
                                <a href="{{ url("$data->url") }}" class="text-decoration-none text-muted">
                                    <img {!! img_meta($data->image_data) !!} class="card-img-especial">
                                    <div class="card-body">
                                        <h3 class="card-title">{!! $data->title !!}</h3>
                                        <p class="card-text">{!! $data->post_excerpt !!}</p>
                                        <small class="text-muted">{{ date('M/d/Y', strtotime($data->post_date)) }}</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                    {{ $destinationposts->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
                <!-- BOTONES CATEGORIAS -->
                @include('menus.menu_footer_categories')
                <!-- BOTONES CATEGORIAS -->
            </div>
        </div>
    </main>
@endsection
