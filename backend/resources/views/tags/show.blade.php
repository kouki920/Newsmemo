@extends('app')

@section('title', $tag->hashtag)

@section('content')

<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    @include('tags.tags')
</div>
<div class="container">
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('tags.pagination')
</div>
@endsection