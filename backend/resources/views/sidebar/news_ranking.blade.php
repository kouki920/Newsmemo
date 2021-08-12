<div class="card-body news-ranking-body">
    <ul class="list-group">
        <li class="list-group-item bg-info text-center">読まれているニュースTOP3</li>
    </ul>
    @foreach($ranked_news as $news)
    <div class="list-group">
        <a href="{{$news->url}}" class="list-group-item list-group-item-action text-center" target=”_blank” rel="noopener noreferrer">
            <p class="h6">{!! nl2br(e(Str::limit($news->news,60))) !!}</p>
        </a>
    </div>
    @endforeach
</div>