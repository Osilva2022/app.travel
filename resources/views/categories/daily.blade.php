@extends('layouts.app')
@section('page-title')
    Tribune | Daily Briefing
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 90px;">
        @livewire('daily-briefing')
        <hr style="margin-bottom: 60px;">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Guide</h2>
                    <p>There is always something new to discover. <br>
                        Learn about the best spots you can visit to dine, sip, pamper yourself and have the best of times.
                    </p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 my-4">
                @foreach ($things_categories as $tc)
                    <div class="col">
                        <a href="{{ route('guide_category', ['puerto-vallarta', "$tc->slug"]) }}"
                            class="text-decoration-none">
                            <div class="card border-0">
                                <div class="position-relative zoom">
                                    <div class="opacity-effect"
                                        style="border-radius: 1rem; background:{!! $tc->category_color !!};"></div>
                                    <img {!! img_meta($tc->image_data, $tc->image_alt) !!} class="card-img-secundario">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title" style="color:{!! $tc->category_color !!};">
                                        {!! $tc->name !!}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        #datepicker i {
            position: absolute;
            right: 0px;
            top: 0px;
            z-index: -1;
        }

        #datepicker,
        #datepicker:focus-visible {
            border: none;
            outline: none;
            width: 140px;
            font-family: objektiv-mk2;
            font-size: 1.25rem;
            font-weight: 400;
            font-style: normal;
            color: #101820;
            line-height: 1.5rem;
            cursor: pointer;
            color: #101820;
        }

        .gap-8 {
            gap: 2rem
                /* 32px */
            ;
        }

        .father {
            /* padding: 40px;
                                                                                        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31);
                                                                                        -webkit-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31);
                                                                                        -moz-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31); */
            max-width: 768px;
            margin-bottom: 60px;
            /* background-color: rgb(242 242 242);
                                                                                        position: relative; */
        }

        /* .daily-cont-1:hover,
                                                                                    .daily-cont-2:hover {
                                                                                        transform: scale(1.01);
                                                                                        transition-duration: 200ms;
                                                                                        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.1);
                                                                                        -webkit-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.1);
                                                                                        -moz-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.1);
                                                                                    } */

        .daily-cont-1,
        .daily-cont-2 {
            position: relative;
            width: 100%;
            padding: 20px;
            /* border-bottom: solid 1px black; */
            box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31);
            -webkit-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31);
            -moz-box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.31);
            border-radius: 8px;
            margin-bottom: 32px;
            display: inline-block;
            background-color: white;
        }

        .daily-cont-1 img {
            width: 100%;
            height: auto;
            aspect-ratio: 4/3;
            border-radius: 8px;
            margin-bottom: 16px;
            object-fit: cover;
        }

        .daily-cont-1 h2 {
            font-size: 22px;
            font-weight: 800;
            line-height: 24px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .daily-cont-1 p {
            font-size: 16px;
            line-height: 22px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 6;
        }

        .daily-cont-2 img {
            width: 33%;
            height: auto;
            aspect-ratio: 4/3;
            border-radius: 8px;
            margin-right: 16px;
            object-fit: cover;
        }

        .daily-cont-2 h2 {
            font-size: 18px;
            font-weight: 800;
            line-height: 19px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .daily-cont-2 p {
            font-size: 14px;
            line-height: 20px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        @media (min-width: 768px) {
            .md\:columns-2 {
                columns: 2;
            }
        }
    </style>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $("#datepicker").datepicker({
            maxDate: 0,
            dateFormat: 'yy-mm-dd'
        });
    </script>
@endpush
