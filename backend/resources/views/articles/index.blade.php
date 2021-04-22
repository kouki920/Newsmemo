@extends('app')

@section('title', '記事一覧')
@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('articles.pagination')
</div>
@endsection