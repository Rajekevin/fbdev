<div class="images_container">
    @for($i = 0; $i < 3; $i++)
        @include('frontend.html.pages.home.contest.item.item', ['index' => $i])
    @endfor
</div>
