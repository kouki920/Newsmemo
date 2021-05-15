@extends('app')

@section('title', $user->name . 'がいいねした記事')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => true])
</div>
<div class="container">
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('articles.pagination')
</div>
@endsection