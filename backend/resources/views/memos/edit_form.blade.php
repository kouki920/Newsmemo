<div class="form-outline mt-3">
    <form action="{{route('memos.update', compact('memo','article'))}}" method="POST">
        @csrf
        <textarea class="form-control add-memo-textarea" id="textAreaExample" rows="4" name="memo" placeholder="メモを入力する">{{$memo->memo ?? old('memo')}}</textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <div class="float-right">
            <input type="submit" class="btn blue-gradient btn-block mt-2" style="width: 100px;" value="更新">
        </div>
    </form>
    <a href="{{route('articles.show',compact('article'))}}">
        <input type="submit" class="btn blue-gradient btn-block mt-2" style="width: 100px;" value="キャンセル">
    </a>
</div>