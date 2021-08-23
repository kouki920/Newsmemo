<div class="card article-body">
    <div class="card-body article-content">
        <div class="article-icon-name">
            <a href="{{route('users.show',['name'=>$article->user->name])}}" class="article-icon">
                @if(empty($article->user->image))
                <i class="fas fa-user-circle fa-3x profile-icon"></i>
                @else
                <img class="article-icon image-upload rounded-circle img-responsive" src="/storage/{{$article->user->image}}" alt="ユーザーアイコン">
                @endif
            </a>
            <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="article-name font-md text-dark">
                {{$article->user->name}}
            </a>
        </div>
        <!-- ログインユーザーidと投稿idが同じ場合のみ表示させる -->
        @if( Auth::id() === $article->user_id )
        <!-- dropdown -->
        <div class="article-edit-button card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted m-0 p-2">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item edit-text" href="{{ route('articles.edit', compact('article')) }}">
                        <i class="fas fa-pen edit-icon"></i>編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete-text" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                        <i class="fas fa-trash-alt delete-icon"></i>削除
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
                        <div class="modal-body">
                            投稿したメモを本当に削除しますか?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除</button>
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
    <div class="card-body article-body-content">
        <div class="card-text">
            <a class="font-sm text-dark text-decoration-none" href="{{route('articles.show',compact('article'))}}">
                {!! nl2br(e( $article->body )) !!}
            </a>
        </div>
    </div>
    @foreach($article->tags as $tag)
    @if($loop->first)
    <div class="card-body pt-0 pb-2 pl-3">
        <div class="card-text line-height">
            @endif
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted font-sm">
                {{ $tag->hashtag }}
            </a>
            @if($loop->last)
        </div>
    </div>
    @endif
    @endforeach
    @if(isset($article->newsLink))
    <div class="card-text article-news-link pt-0 pb-2 pl-3">
        <a class="font-sm article-news-link-text" href="{{$article->newsLink->url}}" target=”_blank” rel="noopener noreferrer">関連記事:{{$article->newsLink->news}}</a>
    </div>
    @endif
    <div class="card-text pt-0 pl-3 font-weight-lighter">
        {{$article->created_at->format('Y/m/d H:i')}}
    </div>
    <div class="row card-body pt-0 pb-0 pl-3">
        <div class="card-text col-12 clearfix">
            <div class="float-left">
                <article-like :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))' :initial-count-likes='@json($article->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('articles.like', ['article' => $article]) }}">
                </article-like>
            </div>
            <div class="float-right">
                <a class="dropdown-item text-success float-left" data-toggle="modal" data-target="#modal-store-{{ $article->id }}">
                    <i class="far fa-folder fa-lg"></i>
                </a>
                <!-- <a class="dropdown-item text-danger float-left" data-toggle="modal" data-target="#modal-collection-delete-{{ $article->id }}">
                    <i class="far fa-folder fa-lg"></i>
                </a> -->
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
    </div>
</div>