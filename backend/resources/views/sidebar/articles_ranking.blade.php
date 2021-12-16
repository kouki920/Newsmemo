<div class="card-body articles-ranking-body">
    <ul class="list-group">
        <li class="list-group-item articles-ranking-body__title font-sm">トレンドメモTOP3</li>
    </ul>
    @foreach($rankedArticles as $article)
    <div class="list-group">
        <a href="{{route('articles.show',compact('article'))}}" class="list-group-item list-group-item-action articles-ranking-body__content">
            <p class="font-sm">{!! nl2br(e(Str::limit($article->body,40))) !!}<br><i class="fas fa-bookmark fa-fw"></i>{{$article->likes_count}}件</p>
        </a>
    </div>
    @endforeach
</div>