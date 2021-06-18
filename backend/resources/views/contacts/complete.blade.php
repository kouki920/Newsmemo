@extends('app')

@section('title', '完了画面')

@section('content')
@include('nav')

<div class="card text-center m-3">
    <div class="card-header">完了画面</div>
    <div class="card-body">
        <h5 class="card-title">お問い合わせありがとうございます</h5>
        <p class="card-text">
            今後ともどうぞよろしくお願い申し上げます。
        </p>
        <a href="{{route('articles.index')}}" class="btn btn-primary">トップページに戻る</a>
    </div>
</div>
@endsection