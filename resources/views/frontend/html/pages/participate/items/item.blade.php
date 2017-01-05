@if(isset($photo))
<div class="album_item" id="photo_{{ $photo['id'] }}">
    <img src="{{ $photo['picture'] }}" alt="{{ $photo['name'] }}">
</div>
@endif