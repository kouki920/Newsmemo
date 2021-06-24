<div class="card-body p-3">
    <ul class="list-group mt-3">
        <li class="list-group-item bg-info text-center">トレンドメモTOP3</li>
    </ul>
    @foreach($ranked_articles as $article)
    <div class="list-group">
        <a href="{{route('articles.show',compact('article'))}}" class="list-group-item list-group-item-action text-center">
            <p class="h6">{!! nl2br(e(Str::limit($article->body,60))) !!}<br><i class="fas fa-bookmark fa-fw"></i>{{$article->likes_count}}件</p>
        </a>
    </div>
    @endforeach
</div>