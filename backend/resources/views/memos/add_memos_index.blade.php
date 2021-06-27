<ul class="list-group">
    @if( $article->id === $memo->article_id )
    <li class="list-group-item d-flex justify-content-between">
        <div class="d-flex align-items-center ">{!! nl2br(e( $memo->body )) !!}</div>
        <!-- dropdown -->
        <div class="card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted m-0 p-2">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('memos.edit', ['memo' => $memo->id]) }}">
                        編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('memos.destroy', ['memo' => $memo->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="dropdown-item" value="削除">
                    </form>
                </div>
            </div>
        </div>
        <!-- dropdown -->
    </li>
    @endif
</ul>