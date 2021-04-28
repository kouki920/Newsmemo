@extends('app')

@section('title', 'ニュース一覧')

@section('content')
<div class="sticky-top">
    @include('nav')
    <div class="mx-auto" style="width: 1100px;">
        @include('articles.tabs', ['hasNewsApi' => true, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
        @include('articles.news_tabs')
    </div>
</div>
<div class="container">
    @foreach($news as $data)
    @include('articles.news')
    @endforeach
</div>
@endsection