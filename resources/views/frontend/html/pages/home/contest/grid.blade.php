<div class="images_container">
    @php
        $contestHelper = new \App\Helpers\ContestHelper();
        $contestData = $contestHelper->getCurrentContestData();
    @endphp
    @foreach($contestData as $contestItem)
        @include('frontend.html.pages.home.contest.item.item', ['item' => $contestItem])
    @endforeach
</div>
