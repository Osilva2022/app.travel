@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '405')
@section('message', __('Sorry, Method not Allowed.'))
@section('image')
    <div style="background-image: url(https://storage.googleapis.com/tribunetravel/2022/08/puerto-vallarta-playa.jpg)" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection
