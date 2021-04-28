@extends('app')

@section('title','メモ編集')

@section('content')
<div class="sticky-top">
    @include('nav')
    <div class="mx-auto" style="width: 1100px;">
        @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_list')
                    <div class="card-text">
                        <form action="{{route('articles.update',compact('article'))}}" method="POST">
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