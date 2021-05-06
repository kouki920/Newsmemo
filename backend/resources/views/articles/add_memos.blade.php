<div>
    <div class="form-outline">
        <label class="form-label" for="textAreaExample">非公開メモ</label>
        <textarea class="form-control" id="textAreaExample" rows="4" name="memo" placeholder="メモ"></textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <button type="submit" class="btn blue-gradient btn-block">保存</button>
    </div>
</div>