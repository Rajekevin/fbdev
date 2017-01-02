<div class="content_concours">
    @for($i = 0; $i < 10; $i++)
        @include('frontend.html.pages.home.contest.item.item', ['index' => $i])
    @endfor
</div>