@extends('app')

@section('title', 'コレクション一覧')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="row col-md-12">
        @foreach($collections as $collection)
        @include('collections.collection')
        @endforeach
    </div>
</div>
@endsection