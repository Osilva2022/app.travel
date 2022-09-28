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
    </style>
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.8rem;">
        <div class="container py-4" style="max-width: 920px;">
            <div class="row">
                <div class="col-12">
                    <h1>Contact Us</h1>
                </div>
                <div class="col-md-6">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab adipisci magni, fugit aliquam provident
                        incidunt eaque rerum, itaque nulla laudantium in perferendis suscipit facilis sed maiores voluptas
                        harum laboriosam fuga?
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="" id="msg" style="display: none;"></div>
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
                                cols="30" rows="3">{{ old('message') }}</textarea>
                            {!! $errors->first('message', '<div class="invalid-feedback">:message</div>') !!}
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
@endsection
