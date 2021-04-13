@csrf
<div class="md-form">
    <label>タイトル</label>
    <br>
    <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
    <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
    </article-tags-input>
</div>
<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="card-footer text-muted mb-3">関連記事:&nbsp;<a href="{{$url}}" target=”_blank” rel="noopener noreferrer">{{$news}}</a>
</div>
<button type="submit" class="btn blue-gradient btn-block">投稿する</button>