@extends('app')

@section('title', $tag->hashtag)

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    @include('tags.tags')
    @foreach($tag->articles as $article)
    @include('articles.post')
    @endforeach
</div>
@endsection