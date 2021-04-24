@extends('app')

@section('title', '設定')
@section('content')
@include('nav')
<div class="container">
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
    <ul class="list-group mt-3">
        <li class="list-group-item bg-info">設定</li>
    </ul>
    <div class="list-group">
        <a href="{{ route('password.request') }}" class="list-group-item list-group-item-action">パスワードの再設定</a>
        <a href="#" class="list-group-item list-group-item-action">お問い合わせ</a>
        <a href="#" class="list-group-item list-group-item-action">利用規約</a>
        <a href="#" class="list-group-item list-group-item-action">退会手続き</a>
    </div>
</div>
@endsection