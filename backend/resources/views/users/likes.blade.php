@extends('app')

@section('title', $user->name . 'がいいねした記事')

@section('content')
@include('nav')
<div class="container">
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => true])
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
</div>
@endsection