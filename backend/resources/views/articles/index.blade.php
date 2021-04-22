@extends('app')

@section('title', '記事一覧')
@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    <form class="form-inline my-2 my-lg-0">
        @csrf
        <input class="form-control mr-sm-2" type="search" name="search" value="{{request('search')}}" placeholder="検索" aria-label="Search">

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>

    </form>
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('articles.pagination')
</div>
@endsection