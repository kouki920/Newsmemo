<div>
    <div class="form-outline mt-3">
        <form action="{{route('memos.store', compact('article'))}}" method="POST">
            @csrf
            <textarea class="form-control add-memo-textarea" id="textAreaExample" rows="4" name="memo" placeholder="メモを入力する">{{old('memo')}}</textarea>
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <button type="submit" class="btn blue-gradient btn-block col-auto mx-auto mt-2" style="width: 100px;">保存</button>
        </form>
    </div>
</div>