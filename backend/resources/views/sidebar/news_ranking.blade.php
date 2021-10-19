<div class="card-body news-ranking-body">
    <ul class="list-group">
        <li class="list-group-item news-ranking-body__title font-sm">トレンドニュースTOP3</li>
    </ul>
    @foreach($ranked_news as $news)
    <div class="list-group">
        <a href="{{$news->url}}" class="list-group-item list-group-item-action news-ranking-body__content" target=”_blank” rel="noopener noreferrer">
            <p class="font-sm">{!! nl2br(e(Str::limit($news->news,60))) !!}</p>
        </a>
    </div>
    @endforeach
</div>