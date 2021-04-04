@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
@include('nav')
<div class="container">
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followers as $user)
    @include('users.user')
    @endforeach
</div>
@endsection