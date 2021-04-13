@extends('app')

@section('title', '記事投稿')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_list')
                    <div class="card-text">
                        <form method="POST" action="{{ route('articles.store') }}">
                            @csrf
                            @include('articles.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection