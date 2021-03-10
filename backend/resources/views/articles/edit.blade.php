@extends('app')

@section('title','編集')

@section('content')

@include('nav')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_list')
                    <div class="card-text">
                        <form action="{{route('articles.update',['article' => $article->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            @include('articles.form')
                            <button type="submit" class="btn blue-gradient btn-block">更新</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection