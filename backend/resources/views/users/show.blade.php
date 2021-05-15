@extends('app')

@section('title', $user->name)

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
</div>
<div class="container">
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('articles.pagination')
</div>
@endsection