@extends('app')

@section('title', 'COVID-19ニュース一覧')

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => true,'hasArticles' => false,'hasMypage' => false])
    @include('articles.covidnews_tabs')
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
</div>
@endsection