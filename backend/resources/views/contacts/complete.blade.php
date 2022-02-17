@extends('app')

@section('title', '完了画面')

@section('content')
@include('nav')

<div class="card complete-body">
    <div class="card-header complete-body__header font-md">-&ensp;送信完了のお知らせ&ensp;-</div>
    <div class="card-body">
        <div class="card-title font-sm">お問い合わせありがとうございます</div>
        <div class="font-sm">今後ともどうぞよろしくお願い申し上げます</div>
        <a href="{{route('articles.index')}}" class="btn complete-body__complete-button font-sm">トップページに戻る</a>
    </div>
</div>
@endsection