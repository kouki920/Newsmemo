<div class="form-outline memo-body__edit-form">
    <form action="{{route('memos.update', compact('memo','article'))}}" method="POST">
        @csrf
        @method('PATCH')
        <textarea class="form-control memo-body__textarea font-sm" id="textAreaExample" rows="3" name="body" placeholder="アウトプットを追加">{{$memo->body ?? old('body')}}</textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <div class="float-right">
            <input type="submit" class="btn font-sm memo-body__update-button" value="更新">
        </div>
    </form>
    <div class="float-left">
        <a href="{{route('articles.show',compact('article'))}}">
            <input type="submit" class="btn font-sm memo-body__cancel-button" value="キャンセル">
        </a>
    </div>
</div>