@extends('app')

@section('title', $user->name)

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false,'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
</div>
@endsection