@extends('layouts.app')
@section('page-title')
    Subscribe |
@endsection
@section('content')
    <style>
        .btn-submit-contact {
            background-color: #243A85;
            color: #ffffff;
            border-radius: .5rem;
            padding: 8px;
            width: 100%;
            text-align: center;
            border: none;
        }

        .btn-submit-contact:hover {
            opacity: .85;
            color: #ffffff;
        }

        .alert-msg {
            --bs-alert-color: #084298;
            --bs-alert-bg: #fff;
            --bs-alert-border-color: #b6d4fe;
        }
    </style>
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 2.5rem">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card-body p-5">
                                <h1 class="text-uppercase text-center mb-5">Suscribe to our newsletter.</h1>
                                @if (session()->has('success'))
                                    <script>
                                        $(document).ready(function() {
                                            setTimeout(
                                                function() {
                                                    const alert = bootstrap.Alert.getOrCreateInstance('#alert-msg')
                                                    alert.close()
                                                }, 5000);
                                        });
                                    </script>
                                    <div class="alert alert-msg alert-dismissible fade show" role="alert" id="alert-msg">
                                        {{ session()->get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                            style="font-size: 8px;"></button>
                                    </div>
                                @elseif(session()->has('error'))
                                    <script>
                                        $(document).ready(function() {
                                            setTimeout(
                                                function() {
                                                    const alert = bootstrap.Alert.getOrCreateInstance('#alert-msg')
                                                    alert.close()
                                                }, 5000);
                                        });
                                    </script>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                        id="alert-msg">
                                        {{ session()->get('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                            style="font-size: 8px;"></button>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('save_subscription') }}" autocomplete="off"
                                    name="form1">
                                    @csrf
                                    <div class="mb-3">
                                        <input class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                            type="text" name="fullname" placeholder="Full name"
                                            value="{{ old('fullname') }}">
                                        {!! $errors->first('fullname', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div id="accordion">
                                        <div>
                                            <p class="accordion-header" id="headingOne"
                                                style="font-size: 20px; color:#243A85;">
                                                Categories:
                                            </p>
                                            <p style="font-size: 16px; color:#243A85; font-weight:600;">Choose those topics
                                                you love:</p>
                                            <div aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <input type="checkbox" name="group4" style="font-size: 20px;"
                                                        value="1" class="form-check-input tag-check" id="select_all">
                                                    <label class="form-check-label">
                                                        Selected all
                                                    </label>
                                                    @foreach ($categories_data as $category)
                                                        <div class="form-check" style="font-size: 14px;">
                                                            <input class="form-check-input tag-check" type="checkbox"
                                                                name="category[]" value="{!! $category->term_id !!}"
                                                                id="tag-{!! $category->term_id !!}">
                                                            <label class="form-check-label"
                                                                for="tag-{!! $category->term_id !!}">
                                                                {!! $category->name !!}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        {!! $errors->first('category', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div
                                        class="mb-3 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-6 pull-center">
                                            {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <div class="invalid-feedback">{{ $errors->first('g-recaptcha-response') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn-submit-contact" type="submit">SUBSCRIBE</button>
                                    </div>
                                    <div class="mb-3">
                                        <p>Subscription implies acceptance of the <a href="">terms and conditions</a></p>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        @include('menus.menu_footer_categories')
    </main>
    <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
@endsection
@yield('jquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#select_all').change(function() {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if ($(this).prop('checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });
    });
</script>
