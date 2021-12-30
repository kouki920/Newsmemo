@extends('app')

@section('title', 'コレクションの詳細')

@section('content')

<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    @include('collections.collections_name')
</div>
<div class="container">
    @foreach($articles as $article)
    @include('collections.post')
    @endforeach
    @include('collections.pagination')
</div>
@endsection