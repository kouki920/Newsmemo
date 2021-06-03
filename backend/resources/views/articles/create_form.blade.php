<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ old('body') }}</textarea>
</div>
<div class="form-group">
    <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
    </article-tags-input>
</div>
<div class="form-group card-footer text-muted mb-3">
    <input type="hidden" name="news" value="{{$news}}">
    <input type="hidden" name="url" value="{{$url}}">
    関連記事:&nbsp;<a href="{{$url}}" target=”_blank” rel="noopener noreferrer">{{$news}}</a>
</div>
<button type="submit" class="btn blue-gradient btn-block">投稿する</button>