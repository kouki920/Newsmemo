@extends('app')

@section('title', '404エラー')

@section('content')
@include('nav')

<div class="card text-center m-3">
    <div class="card-header">エラーページ</div>
    <div class="card-body">
        <h5 class="card-title">エラーが発生しました</h5>
        <p class="card-text">
            お手数をおかけしますが、お問い合わせフォームにてご連絡いただきますようお願い致します
        </p>
        <a href="{{route('articles.index')}}" class="btn btn-primary">トップページに戻る</a>
    </div>
</div>
@endsection