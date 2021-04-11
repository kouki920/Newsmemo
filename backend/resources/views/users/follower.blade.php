@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false,'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.follow_tabs', ['hasFollows' => false, 'hasFollowers' => true])
    @foreach($followers as $user)
    @include('users.user')
    @endforeach
</div>
@endsection