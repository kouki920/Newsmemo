@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false,'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.follow_tabs', ['hasFollows' => true, 'hasFollowers' => false])
    @foreach($followings as $user)
    @include('users.user')
    @endforeach
</div>
@endsection