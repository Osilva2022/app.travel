@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('image')
    <div style="background-image: url(https://storage.googleapis.com/tribunetravel/2022/08/puerto-vallarta-playa.jpg)" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection
