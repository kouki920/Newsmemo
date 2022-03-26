<div class="card article-body">
    <div class="card-body article-body__content">
        <div class="article-body__icon-name">
            <a href="{{route('users.show',['name'=>$article->user->name])}}" class="article-body__icon">
                @if(empty($article->user->image))
                <i class="fas fa-user-circle fa-3x profile-icon"></i>
                @else
                <img class="article-icon image-upload rounded-circle img-responsive" src="{{$article->user->image}}" alt="ユーザーアイコン">
                @endif
            </a>
            <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="article-body__name font-md">
                {{$article->user->name}}
            </a>
        </div>
        <!-- ログインユーザーidと投稿idが同じ場合のみ表示させる -->
        @if( Auth::id() === $article->user_id )
        <!-- dropdown -->
        <div class="article-body__dropdown-button card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted m-0 p-2">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item edit-button font-sm" href="{{ route('articles.edit', compact('article')) }}">
                        編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete-button font-sm" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                        削除
                    </a>
                </div>
            </div>
        </div>
        <!-- dropdown -->

        <!-- 削除 modal -->
        <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('articles.destroy', compact('article')) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body article-body__modal-delete-text font-sm">
                            投稿したメモを本当に削除しますか?
                        </div>
                        <div class="modal-footer article-body__modal-button">
                            <a class="btn font-sm article-body__modal-button--cancel" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn font-sm article-body__modal-button--delete">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- コレクション 非同期 modal -->
        <div id="modal-store-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <collection :initial-collections='@json($collectionNames ?? [])' :autocomplete-items='@json($allCollectionNames ?? [])' endpoint="{{ route('collections.store', ['article' => $article]) }}">
                                <collection>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card-body article-body__content">
        <div class="card-text">
            <a class="font-sm article-body__content-text" href="{{route('articles.show',compact('article'))}}">
                {!! nl2br(e( $article->body )) !!}
            </a>
        </div>
    </div>
    @foreach($article->tags as $tag)
    @if($loop->first)
    <div class="card-body article-body__hashtag">
        <div class="card-text">
            @endif
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="article-body__hashtag-text font-sm">
                {{ $tag->hashtag }}
            </a>
            @if($loop->last)
        </div>
    </div>
    @endif
    @endforeach
    @if(isset($article->newsLink))
    <div class="card-text article-body__news-link">
        <a class="font-sm article-body__news-link-text" href="{{$article->newsLink->url}}" target=”_blank” rel="noopener noreferrer">関連記事:{{$article->newsLink->news}}</a>
    </div>
    @endif
    <div class="card-text article-body__date font-sm">
        {{$article->created_at->format('Y/m/d H:i')}}
    </div>
    <div class="article-body__async-button card-body">

        <article-like :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))' :initial-count-likes='@json($article->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('articles.like', ['article' => $article]) }}">
        </article-like>

        <div class="article-body__collection-button">
            <a class="dropdown-item article-body__collection-add-button" data-toggle="modal" data-target="#modal-store-{{ $article->id }}">
                <i class="far fa-folder fa-lg article-body__collection-add-icon"></i>
            </a>
            <a class="dropdown-item article-body__collection-delete-button" data-toggle="modal" data-target="#modal-collection-delete-{{ $article->id }}">
                <i class="far fa-folder fa-lg article-body__collection-delete-icon"></i>
            </a>
        </div>

        <!-- コレクション 非同期 modal -->
        <div id="modal-store-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <collection :initial-collections='@json($collectionNames ?? [])' :autocomplete-items='@json($allCollectionNames ?? [])' endpoint="{{ route('collections.store', ['article' => $article]) }}">
                                <collection>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- コレクション 削除 modal -->
        <div id="modal-collection-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('collections.article_collection_destroy', ['article' => $article, 'collection' => $collections, 'id' => Auth::id()]) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body font-sm article-body__collection-delete-text">
                            コレクションから削除しますか?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn font-sm article-body__collection-modal-cancel-button" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn font-sm article-body__collection-modal-delete-button">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>