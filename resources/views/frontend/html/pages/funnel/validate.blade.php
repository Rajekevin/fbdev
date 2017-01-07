@extends('frontend.html.pages.funnel')

@section('funnel_content')
    <div class="participate_content">
        @include('frontend.html.pages.funnel.validate.left', ['data' => $tmp_photo])
        @include('frontend.html.pages.funnel.validate.right', ['data' => $tmp_photo])
    </div>
@endsection