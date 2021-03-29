@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
@include('nav')
<div class="container">
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followings as $user)
    @include('users.user')
    @endforeach
</div>
@endsection