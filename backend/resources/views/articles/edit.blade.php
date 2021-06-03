@extends('app')

@section('title','メモ編集')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_list')
                    <div class="card-text">
                        <form action="{{route('articles.update', ['article' => $article])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            @include('articles.edit_form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection