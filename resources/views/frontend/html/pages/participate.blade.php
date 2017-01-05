@extends('frontend.layout')

@section('title', 'Je participe')

@include('frontend.html.pages.participate.title')

@section('content')
    <div class="participate_content">
        @include('frontend.html.pages.participate.albums', ['albums' => $albums])
        @include('frontend.html.pages.participate.grid', ['albums' => $albums])
    </div>
    @include('frontend.html.pages.participate.valid')
@endsection

@section('footer')
    @include('frontend.html.footer')
@endsection