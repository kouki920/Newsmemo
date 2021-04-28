@extends('app')

@section('title', 'COVID-19ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => true, 'hasArticles' => false,'hasMypage' => false])
    @include('articles.covidnews_tabs')
</div>
<div class="container">
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
    @include('articles.top_button')
</div>
@endsection