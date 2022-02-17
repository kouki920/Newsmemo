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
    <a class="font-sm article-create-body__news-link" href="{{$url}}" target=”_blank” rel="noopener noreferrer">関連記事:{{$news}}</a>
</div>
<button type="submit" class="btn article-create-body__create-button font-sm">投稿する</button>