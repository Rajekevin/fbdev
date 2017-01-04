@extends('frontend.layout')

@section('title', 'Je participe')

@section('content')
    @include('frontend.html.pages.participate.title')
    <div class="participate-content">
        @include('frontend.html.pages.participate.albums')
        @include('frontend.html.pages.participate.grid')
    </div>
    @include('frontend.html.pages.participate.valid')
@endsection
