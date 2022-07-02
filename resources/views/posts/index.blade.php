@extends('layouts.app')
<!-- Metadatos -->

<!-- content -->
@section('content')
    <header>
        @include('posts.menu')
        @include('posts.carousel')
    </header>
    <main>
        <div class="container">
            <!-- REVIEWS -->
            <div class="row">
                <h4>Tribune Reviews</h4>
                <div class="col-lg-6">
                    <div class="card mb-3 border-0">
                        <div class="card border-0">
                            <img src="{{ $review->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                                width="100%" height="220">
                            <a href="{{ route('posts.show', $review) }}" title="{{ $review->title }}"
                                class="text-decoration-none text-muted">
                                <div class="card-img-overlay text-white h-100">
                                    @foreach ($categories as $cat)
                                        @if ($review->main_category == $cat->name)
                                            <span class="badge"
                                                style="background:{{ $cat->meta_value }};">{{ $review->main_category }}</span>
                                        @endif
                                    @endforeach
                                    <span class="badge float-end">
                                        <img src="{{ asset('img/estrella.png') }}" alt="destacada" width="25"
                                            height="25">
                                    </span>
                                    <h5 class="card-title position-absolute" style="bottom: 1.5rem;">{{ $review->title }}
                                    </h5>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('posts.show', $review) }}" title="{{ $review->title }}"
                                    class="text-decoration-none text-muted">
                                    {!! Str::limit($review->content, 225, ' ...') !!}
                                </a>
                            </p>
                            <p class="card-text"><small
                                    class="text-muted">{{ $review->post_date->format('d M Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            @foreach ($reviews as $data)
                                @if ($review->ID != $data->ID)
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-5">
                                                <a href="{{ route('posts.show', $data) }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="180">
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <div class="card-body">
                                                    @foreach ($categories as $cat)
                                                        @if ($data->main_category == $cat->name)
                                                            <span class="card-title badge fs-6"
                                                                style="background:{{ $cat->meta_value }};">
                                                                {{ $data->main_category }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                    <p class="card-text">
                                                        <a href="{{ route('posts.show', $data) }}"
                                                            class="text-decoration-none text-muted">
                                                            {!! Str::limit($data->title, 100, ' ...') !!}
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{ $data->post_date->format('d M Y') }}
                                                        </small>
                                                    </p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                         


                        </div>
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary form-control rounded-pill" type="button">More
                                Reviews</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- REVIEWS -->
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <hr>
                </div>
            </div>
            <!-- NEWS -->
            <div class="row">
                <h4>News</h4>
                <div class="col-lg-6">
                    <div class="card mb-4 border-0">
                        <img src="{{ $new->image }}" class="bd-placeholder-img card-img-top rounded-4 shadow"
                            width="100%" height="220">
                        <a href="{{ route('posts.show', $new) }}" title="{{ $new->title }}"
                            class="text-decoration-none text-muted">
                            <div class="card-img-overlay text-white">
                                <span class="badge bg-primary">{{ htmlspecialchars($new->main_category) }}</span>
                                <h5 class="card-title position-absolute" style="bottom: 1.5rem;">{{ $new->title }}
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($news as $data)
                            @if ($new->ID != $data->ID)
                                <div class="col-12">
                                    <div class="card mb-3 border-0">
                                        <div class="row g-0">
                                            <div class="col-5">
                                                <a href="{{ route('posts.show', $data) }}"
                                                    class="text-decoration-none text-muted">
                                                    <img src="{{ $data->image }}"
                                                        class="bd-placeholder-img card-img-top rounded-4 shadow"
                                                        width="100%" height="180">
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <div class="card-body">
                                                    <span class="card-title badge bg-primary fs-6">
                                                        {{ $data->main_category }}
                                                    </span>
                                                    <p class="card-text">
                                                        <a href="{{ route('posts.show', $data) }}"
                                                            class="text-decoration-none text-muted">
                                                            {!! Str::limit($data->title, 100, ' ...') !!}
                                                        </a>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{ $data->post_date->format('d M Y') }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary form-control rounded-pill" type="button">More
                                news</button>
                        </div>
                    </div>
                </div>
                <!-- NEWS -->
                <div class="row justify-content-center">
                    <div class="col-12  pb-2 mb-2">
                        <hr>
                    </div>
                </div>
            </div>
    </main>

    <!-- Reviews -->

    {{-- @foreach ($reviews as $data)
        @if ($review->ID == $data->ID)
            Ultimo post
        @else
            <h4>{{ $data->title }}</h4>
            <p>{{ $data->main_category }}</p>
            <a href="{{ route('posts.show', $data) }}">
                <img class="img-fluid" src="{{ $data->image }}" width="250"><br>
                {{ $data->post_date->format('d M Y') }} <br>
            </a>

            <p>{!! Str::limit($data->content, 125, ' ...') !!}</p>
            <strong>By </strong>{{ $data->author->display_name }}
            <br><br>
        @endif
    @endforeach --}}


    {{-- @foreach ($posts as $post)
          @if ($post->category == 'Reviews')    

          @foreach ($categories as $cat)
          @if ($post->category == $cat->name)    
            <span class="badge" style="background:{{ $cat->meta_value }};">{{ $cat->name }}</span> 
         
          @endif
          @endforeach  
          <br> 
          
          
          @foreach ($attachment as $att)
          @if ($att->post_parent = $post->id)
          <a href="{{ route('posts.show', $post->post_name ) }}">
            <img class="img-fluid" src="{{ $att->url }}" width="250"><br>
            {{  $post->post_date  }} <br>            
          </a>
          @endif
          @endforeach
          <a href="{{ route('posts.show', $post->post_name ) }}">
            <h3> {{ $post->post_title }}</h3>
          </a><br>            
          <p>{!! Str::limit($post->post_content , 125, ' ...') !!}</p>        
          <br><br> 
        

          @endif      
        @endforeach --}}
    <br><br><br>
    {{-- <h3>Seccion Things to do</h3> --}}
    <!-- Things to do -->
@endsection
