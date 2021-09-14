@extends('app')

@section('title', 'コレクション一覧')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
</div>
<div class="container">
    @foreach($collections as $collection)
    @include('collections.collection')
    @endforeach
</div>
@endsection