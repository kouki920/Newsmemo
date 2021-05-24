@extends('app')

@section('title', $user->name . 'のデータ')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
    @include('users.profile')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false,'hasData' => true])
</div>
<div class="container">
    @include('users.data_index')
</div>
@endsection