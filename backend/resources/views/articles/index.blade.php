@extends('app')

@section('title', '記事一覧')
@section('content')
@include('nav')
@include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
<div class="container">
    <div class="row col-md-12">
        <aside class="col-3 d-none d-md-block position-fixed">
            @include('sidebar.list')
        </aside>
        <main class="col-md-7 offset-md-5">
            @include('articles.search')
            @foreach($articles as $article)
            @include('articles.post')
            @endforeach
            @include('articles.pagination')
        </main>
    </div>
</div>
@endsection