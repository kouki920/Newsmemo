@extends('app')

@section('title', '記事投稿')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="card article-create-body">
        <div class="card-body article-create-body__content">
            @include('error_list')
            <div class="card-text">
                <form method="POST" action="{{ route('articles.store') }}">
                    @csrf
                    @include('articles.create_form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection