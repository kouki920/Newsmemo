<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control font-sm" rows="10" placeholder="本文">{{ old('body') }}</textarea>
</div>
<div class="form-group font-sm">
    <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
    </article-tags-input>
</div>
<div class="form-group card-footer">
    <input type="hidden" name="news" value="{{$news}}">
    <input type="hidden" name="url" value="{{$url}}">
    <a class="font-sm article-create-news-link-text" href="{{$url}}" target=”_blank” rel="noopener noreferrer">関連記事:{{$news}}</a>
</div>
<div class="article-create-button-body">
    <button type="submit" class="btn article-create-button font-sm">投稿する</button>
</div>