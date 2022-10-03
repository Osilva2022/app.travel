@extends('layouts.app')
@section('page-title')
    Contact Us |
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
    <main style="margin-top: 5.8rem;">
        <div class="container py-4">
            <div class="row">
                <div class="col-12">
                    <h1>Contact Us</h1>
                </div>
                <div class="col-md-6">
                    <p>
                        Do you have something to tell us? We would love to hear from you! If you wish to advertise on our
                        page, give us feedback or even collaborate with us, please leave us a message.
                    </p>
                </div>
                <div class="col-md-6">
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
                    @endif
                    <form method="POST" action="{{ route('save-contact') }}" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" type="text"
                                name="firstname" placeholder="First Name" value="{{ old('firstname') }}">
                            {!! $errors->first('firstname', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="mb-3">
                            <input class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" type="text"
                                name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
                            {!! $errors->first('lastname', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="mb-3">
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text"
                                name="email" placeholder="Email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="mb-3">
                            <input class="form-control {{ $errors->has('zipcode') ? ' is-invalid' : '' }}" type="text"
                                name="zipcode" placeholder="ZIP Code" value="{{ old('zipcode') }}">
                            {!! $errors->first('zipcode', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="mb-3">
                            <select class="form-select {{ $errors->has('id_subject') ? ' is-invalid' : '' }}"
                                name="id_subject">
                                <option value="" disabled selected>Subject</option>
                                @isset($subjects)
                                    @foreach ($subjects as $subject)
                                        <option value="{!! $subject->id_subject !!}"
                                            {{ old('id_subject') == $subject->id_subject ? 'selected' : '' }}>
                                            {!! $subject->description !!}</option>
                                    @endforeach
                                @endisset
                            </select>
                            {!! $errors->first('id_subject', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" id=""
                                cols="30" rows="3" placeholder="Your message">{{ old('message') }}</textarea>
                            {!! $errors->first('message', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Captcha</label>
                            <div class="col-md-6 pull-center">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn-submit-contact" type="submit">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
