<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
            {{ $tag->articles->count() }}件
        </div>
    </div>
</div>