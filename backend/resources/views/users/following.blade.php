@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false,'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.follow_tabs', ['hasFollows' => true, 'hasFollowers' => false])
</div>
<div class="container">
    @foreach($followings as $user)
    @include('users.user')
    @endforeach
</div>
@endsection