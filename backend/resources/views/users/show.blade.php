@extends('app')

@section('title', $user->name)

@section('content')
<div class="sticky-top">
    @include('nav')
    <div class="mx-auto" style="width: 1100px;">
        @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
        @include('users.profile')
        @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
    </div>
</div>
<div class="container mx-auto" style="width: 1100px;">
    @foreach($articles as $article)
    @include('articles.post')
    @endforeach
    @include('articles.pagination')
</div>
@endsection