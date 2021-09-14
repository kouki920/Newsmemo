@extends('app')

@section('title', 'COVID-19ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => true, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="covid-news-index">
        <aside class="covid-news-index-select-menu">
            @include('articles.covidnews_tabs')
            @include('articles.covid_news_side_menu')
        </aside>
        <main class="covid-news-index-body">
            @foreach($news as $data)
            @include('articles.news')
            @endforeach
            @include('articles.top_button')
        </main>
    </div>
</div>
@endsection