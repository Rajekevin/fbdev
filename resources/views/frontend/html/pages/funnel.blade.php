@extends('frontend.layout')

@section('title', 'Je participe')

@include('frontend.html.pages.funnel.title')

@section('content')
    @yield('funnel_content')
@endsection

@section('footer')
    @include('frontend.html.footer')
@endsection