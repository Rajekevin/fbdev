@extends('frontend.html.pages.funnel')

@section('funnel_content')
    <div class="participate_content">
        @include('frontend.html.pages.funnel.choose.albums', ['albums' => $albums])
        @include('frontend.html.pages.funnel.choose.grid', ['albums' => $albums])
    </div>
    @include('frontend.html.pages.funnel.choose.valid')
@endsection