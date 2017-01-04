@extends('frontend.layout')

@section('title', 'Accueil')

@include('frontend.html.header')

@section('content')
    @include('frontend.html.pages.home')
@endsection

@include('frontend.html.footer')