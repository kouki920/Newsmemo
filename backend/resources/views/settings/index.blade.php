@extends('app')

@section('title', '設定')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <ul class="list-group mt-3">
        <li class="list-group-item bg-info">設定</li>
    </ul>
    <div class="list-group">
        <a href="{{ route('password.request') }}" class="list-group-item list-group-item-action py-3"><i class="fas fa-unlock-alt fa-fw mr-3"></i>パスワードの再設定</a>
        <a href="#" class="list-group-item list-group-item-action py-3"><i class="fas fa-envelope fa-fw mr-3"></i>お問い合わせ</a>
        <a href="#" class="list-group-item list-group-item-action py-3"><i class="fas fa-book-open fa-fw mr-3"></i>利用規約</a>
        <a href="#" class="list-group-item list-group-item-action py-3"><i class="fas fa-user-times fa-fw mr-3"></i>退会手続き</a>
    </div>
</div>
@endsection