<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control font-sm" rows="10" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="form-group font-sm">
    <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
    </article-tags-input>
</div>
<div class="form-group card-footer text-muted mb-3">
    <input type="hidden" name="news" value="{{$article->newsLink->news}}">
    <input type="hidden" name="url" value="{{$article->newsLink->url}}">
    &nbsp;<a href="{{$article->newsLink->url}}" class="font-sm" target=”_blank” rel="noopener noreferrer">関連記事:{{$article->newsLink->news}}</a>
</div>
<button type="submit" class="btn user-article-update-button font-sm">更新</button>