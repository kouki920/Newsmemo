@extends('app')

@section('title', '429エラー')

@section('content')
@include('nav')

<div class="card text-center m-3">
    <div class="card-header font-md">エラーページ</div>
    <div class="card-body">
        <h5 class="card-title">リクエスト制限の発生</h5>
        <p class="card-text">
            1分間におけるリクエスト制限が発生しました。
            <br>時間を置いてから、再度ご利用ください。
            <br>お手数をおかけしますが、よろしくお願い致します。
        </p>
        <a href="{{route('articles.index')}}" class="btn btn-primary font-sm">トップページに戻る</a>
    </div>
</div>
@endsection