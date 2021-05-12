@extends('app')

@section('title', '設定')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    @include('settings.agreement_form')
</div>
@include('articles.footer')
@endsection