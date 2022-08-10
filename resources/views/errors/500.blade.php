@extends('errors::illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('image')
    <div style="background-image: url(https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/08/puerto-vallarta-playa.jpg)" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection
