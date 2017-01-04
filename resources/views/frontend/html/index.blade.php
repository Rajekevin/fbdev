@extends('frontend.layout')

@section('title', 'Accueil')

@section('header')
    @include('frontend.html.header')
@endsection

@section('content')
    @include('frontend.html.pages.home')
@endsection

@section('footer')
    @include('frontend.html.footer')
@endsection