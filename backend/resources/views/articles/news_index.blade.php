@extends('app')

@section('title', 'ニュース一覧')

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => true, 'hasCovidNews' => false, 'hasArticles' => false])
    @include('articles.news_tabs')
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
</div>
@endsection