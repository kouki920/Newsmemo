@extends('app')

@section('title', 'お問い合わせフォーム 確認画面')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>

<div class="container">
    @include('contacts.confirm_screen')
</div>

@endsection