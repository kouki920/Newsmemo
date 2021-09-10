<div class="form-outline memo-edit-form">
    <form action="{{route('memos.update', compact('memo','article'))}}" method="POST">
        @csrf
        <textarea class="form-control add-memo-textarea font-sm" id="textAreaExample" rows="3" name="body" placeholder="メモを入力する">{{$memo->body ?? old('body')}}</textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <div class="float-right">
            <input type="submit" class="btn btn-block font-sm update-button" value="更新">
        </div>
    </form>
    <div class="float-left">
        <a href="{{route('articles.show',compact('article'))}}">
            <input type="submit" class="btn btn-block font-sm cancel-button" value="キャンセル">
        </a>
    </div>
</div>