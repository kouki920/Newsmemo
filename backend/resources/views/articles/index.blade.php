@extends('app')

@section('title', '記事一覧')
@section('content')
<div class="sticky-top">
    @include('nav')
    <div class="mx-auto" style="width: 1100px;">
        @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    </div>
</div>
<div class="container">
    <div class="row col-md-12">
        <aside class="col-3 d-none d-md-block position-fixed">
            @include('articles.search')
            @include('sidebar.list')
        </aside>
        <main class="col-md-7 offset-md-5">
            @foreach($articles as $article)
            @include('articles.post')
            @endforeach
            @include('articles.pagination')
        </main>
    </div>
</div>
@endsection