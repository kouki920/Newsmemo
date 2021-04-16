<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <a href="{{route('users.show',['name'=>$article->user->name])}}" class="text-dark">
            @if(empty($article->user->image))
            <i class="fas fa-user-circle fa-3x mr-1"></i>
            @else
            <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$article->user->image}}" width="55" height="55" alt="ユーザーアイコン">
            @endif
        </a>
        <div>
            <div class="font-weight-bold">
                <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                    {{$article->user->name}}
                </a>
            </div>
            <div class="font-weight-lighter">
                {{$article->created_at->format('Y/m/d H:i')}}
            </div>
        </div>
        <!-- ログインユーザーidと投稿idが同じ場合のみ表示させる -->
        @if( Auth::id() === $article->user_id )
        <!-- dropdown -->
        <div class="ml-auto card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted m-0 p-2">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route("articles.edit", compact('article')) }}">
                        <i class="fas fa-pen mr-1"></i>記事を更新する
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                        <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                    </a>
                </div>
            </div>
        </div>
        <!-- dropdown -->

        <!-- modal -->
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
                            {{ $article->title }}を本当に削除しますか?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
        @endif
    </div>
    <div class="card-body pt-0 pb-2">
        <h3 class="h5 card-title">
            <a class="text-dark" href="{{route('articles.show',compact('article'))}}">
                {{$article->title}}
            </a>
        </h3>
        <div class="card-text">
            {!! nl2br(e( $article->body )) !!}
        </div>
    </div>
    @foreach($article->tags as $tag)
    @if($loop->first)
    <div class="card-body pt-0 pb-4 pl-3">
        <div class="card-text line-height">
            @endif
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                {{ $tag->hashtag }}
            </a>
            @if($loop->last)
        </div>
    </div>
    @endif
    @endforeach
    <div class="card-text pt-0 pb-2 pl-3">
        関連記事:<a href="{{$article->url}}" target=”_blank” rel="noopener noreferrer">{{$article->news}}</a>
    </div>
    <div class="card-body pt-0 pb-2 pl-3">
        <div class="card-text">
            <article-like :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))' :initial-count-likes='@json($article->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('articles.like', ['article' => $article]) }}">
            </article-like>
        </div>
    </div>
</div>