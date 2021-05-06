<ul class="list-group">
    @if( $article->id === $memo->article_id )
    <li class="list-group-item">{{$memo->memo}}</li>
    @endif
</ul>