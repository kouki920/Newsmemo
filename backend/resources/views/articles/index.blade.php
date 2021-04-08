@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasArticles' => true])
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
</div>
@endsection