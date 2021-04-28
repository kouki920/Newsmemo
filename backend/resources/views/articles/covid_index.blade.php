@extends('app')

@section('title', 'COVID-19ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    <div class="mx-auto" style="width: 1100px;">
        @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => true, 'hasArticles' => false,'hasMypage' => false])
        @include('articles.covidnews_tabs')
    </div>
</div>
<div class="container">
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
</div>
@endsection