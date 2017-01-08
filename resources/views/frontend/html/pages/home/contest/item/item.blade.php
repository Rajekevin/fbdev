<div class="image_container @if($item['hasAlreadyVote'] === true)have-vote @endif" data-id="image-{{ $item['id'] }}">
    <a data-lightbox="image-{{ $item['id'] }}" href="{{ $item['picture'] }}" style="color:#fff;" target="_blank">
        <img src="{{ $item['picture'] }}" alt=""/>
    </a>
    <div>
        <img src="img/heart.png" alt="heart" class="btn-like">
        <img src="img/share.png" alt="share" class="btn-share">
        <p>{{ $item['nbVotes'] }} vote</p>
    </div>
</div>