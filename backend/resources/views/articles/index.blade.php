@extends('app')

@section('title', '記事一覧')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
</div>
<div class="container">
    <div class="articles-index">
        <aside class="side-menu">
            @include('articles.search')
            @include('sidebar.list')
        </aside>
        <main class="articles-index-body">
            @foreach($articles as $article)
            @include('articles.post')
            @endforeach
            @include('articles.top_button')
            @include('articles.pagination')
        </main>
    </div>
</div>
@endsection