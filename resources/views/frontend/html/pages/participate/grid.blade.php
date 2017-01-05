<div class="participate_block_right">
    @if($albums)
        @foreach($albums as $album)
            @foreach($album['photos'] as $photo)
                @include('frontend.html.pages.participate.items.item', ['item' => $photo])
            @endforeach
        @endforeach
    @endif
</div>