@extends('app')

@section('title', '429エラー')

@section('content')
@include('nav')

<div class="card error-page-body">
    <div class="card-header error-page-body__header font-md">エラーページ</div>
    <div class="card-body">
        <h5 class="card-title font-md">-アクセス制限中です-</h5>
        <p class="card-text font-sm">
            1分間におけるリクエスト制限が発生しました。
            <br>時間を置いてから、再度ニュースを更新してください。
            <br>お手数をおかけしますが、よろしくお願い致します。
        </p>
        <a href="{{route('articles.index')}}" class="btn error-page-body__button font-sm">トップページに戻る</a>
    </div>
</div>
@endsection