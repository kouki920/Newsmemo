@extends('app')

@section('title', 'コレクション一覧')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
</div>
<div class="container">
    <div class="collection-body-title font-md">
        -&ensp;Collection&ensp;-
    </div>
    @foreach($collections as $collection)
    @include('collections.collection')
    @endforeach
</div>
@endsection