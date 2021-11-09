    <div class="form-outline memo-body__create-form">
        <form action="{{route('memos.store', compact('article'))}}" method="POST">
            @csrf
            <textarea class="form-control memo-body__textarea font-sm" id="textAreaExample" rows="3" name="body" placeholder="アウトプットを追加">{{old('body')}}</textarea>
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <div class="memo-body__memo-button-wrap">
                <button type="submit" class="btn memo-body__memo-button font-sm">保存</button>
            </div>
        </form>
    </div>