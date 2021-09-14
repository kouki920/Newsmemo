@extends('app')

@section('title', 'ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => true, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])

</div>
<div class="container">
    <div class="headline-news-index">
        <aside class="headline-news-index-select-menu">
            @include('articles.news_tabs')
            @include('articles.news_side_menu')
        </aside>
        <main class="headline-news-index-body">
            @foreach($news as $data)
            @include('articles.news')
            @endforeach
            @include('articles.top_button')
        </main>
    </div>
</div>
@endsection