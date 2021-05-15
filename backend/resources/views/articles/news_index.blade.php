@extends('app')

@section('title', 'ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => true, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
    @include('articles.news_tabs')
</div>
<div class="container">
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
    @include('articles.top_button')
</div>
@endsection