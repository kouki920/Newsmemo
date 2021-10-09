<div class="user-data-body">
    <div class="user-data-body__title font-sm">
        -ユーザーデータ-
    </div>
    <table class="table table-bordered user-data-body__table">
        <thead>
            <tr class="table-active user-data-body__header">
                <th scope="col" class="font-sm">メモ数</th>
                <th scope="col" class="font-sm">累計投稿日数</th>
                <th scope="col" class="font-sm">最終ログイン</th>
            </tr>
        </thead>
        <tbody>
            <tr class="user-data-body__contents">
                <td class="font-sm">{{$articles_count}}</td>
                <td class="font-sm">{{$days_posted}}</td>
                <td class="font-sm">{{$last_login}}</td>
            </tr>
        </tbody>
    </table>

    <!-- メモランキングデータ -->
    <ul class="list-group">
        <li class="list-group-item user-data-body__articles-ranking-title font-sm">-トレンドメモTOP3-</li>
    </ul>
    @foreach($ranked_articles as $article)
    <div class="list-group">
        <a href="{{route('articles.show',compact('article'))}}" class="list-group-item list-group-item-action user-data-body__articles-ranking-content">
            <p class="font-sm">{!! nl2br(e(Str::limit($article->body,60))) !!}<br><i class="fas fa-bookmark fa-fw"></i>{{$article->likes_count}}件</p>
        </a>
    </div>
    @endforeach

    <!-- 読まれている記事ランキング -->
    <ul class="list-group">
        <li class="list-group-item user-data-body__news-ranking-title font-sm">-トレンドニュースTOP3-</li>
    </ul>
    @foreach($ranked_news as $news)
    <div class="list-group">
        <a href="{{$news->url}}" class="list-group-item list-group-item-action user-data-body__news-ranking-content" target=”_blank” rel="noopener noreferrer">
            <p class="font-sm">{!! nl2br(e(Str::limit($news->news,60))) !!}</p>
        </a>
    </div>
    @endforeach
</div>