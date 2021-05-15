@extends('app')

@section('title','詳細画面')

@section('content')

<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
</div>
<div class="container">
    @include('memos.edit_memos')
</div>
@endsection