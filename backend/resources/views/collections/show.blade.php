@extends('app')

@section('title', $collections->name)

@section('content')

<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => true,'hasMypage' => false])
    @include('collections.collections_name')
</div>
<div class="container">
    @foreach($collections->articles as $article)
    @include('collections.post')
    @endforeach
</div>
@endsection