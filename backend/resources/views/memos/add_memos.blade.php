<div>
    <div class="form-outline memo-form">
        <form action="{{route('memos.store', compact('article'))}}" method="POST">
            @csrf
            <textarea class="form-control add-memo-textarea font-sm" id="textAreaExample" rows="3" name="body" placeholder="メモを入力する">{{old('body')}}</textarea>
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <button type="submit" class="btn btn-block memo-button font-sm">保存</button>
        </form>
    </div>
</div>