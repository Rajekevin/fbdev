<div class="participate_block_left">
    <p>Télécharger une photo depuis mon ordinateur</p>
    <input type="file" name="image_upload" />
    <p class="bold">ou</p>
    <p>depuis mes albums Facebook</p>
    <ul>
        @if($albums)
            @foreach($albums as $album)
                <li id="{{ $album['id'] }}">{{ $album['name'] }}</li>
            @endforeach
        @endif
    </ul>
</div>
