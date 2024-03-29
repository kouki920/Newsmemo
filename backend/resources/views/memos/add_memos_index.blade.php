<ul class="list-group">
    @if( $article->id === $memo->article_id )
    <li class="list-group-item memo-body__content">
        <div class="memo-body__content-text font-sm">{!! nl2br(e( $memo->body )) !!}</div>
        <!-- dropdown -->
        <div class="card-text">
            <div class="dropdown memo-body__button-list">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item memo-edit-button font-sm" href="{{ route('memos.edit', compact('memo','article')) }}">
                        編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('memos.destroy', ['memo' => $memo]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="dropdown-item memo-delete-button font-sm" value="削除">
                    </form>
                </div>
            </div>
        </div>
        <!-- dropdown -->
    </li>
    @endif
</ul>