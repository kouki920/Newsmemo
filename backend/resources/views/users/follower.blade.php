@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false,'hasArticles' => false,'hasMypage' => true])
    @include('users.follow_tabs', ['hasFollows' => false, 'hasFollowers' => true])
</div>
<div class="container">
    @foreach($followers as $user)
    @include('users.user')
    @endforeach
</div>
@endsection