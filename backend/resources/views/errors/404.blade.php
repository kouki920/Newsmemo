@extends('app')

@section('title', '404エラー')

@section('content')
@include('nav')

<div class="card error-page-body">
    <div class="card-header error-page-body__header font-md">エラーページ</div>
    <div class="card-body">
        <h5 class="card-title font-md">-エラーが発生しました-</h5>
        <p class="card-text font-sm">
            お手数をおかけしますが、お問い合わせフォームにてご連絡いただきますようお願い致します
        </p>
        <a href="{{route('articles.index')}}" class="btn error-page-body__button font-sm">トップページに戻る</a>
    </div>
</div>
@endsection