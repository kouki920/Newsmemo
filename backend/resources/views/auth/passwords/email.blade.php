@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="sticky-top">
    <nav class="navbar navbar-expand navbar-dark">
        <a class="navbar-brand font-md" href="{{route('news.default_index')}}"><i class="far fa-sticky-note mr-1"></i>Newsmemo</a>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link font-sm" href="{{route('register')}}">ユーザー登録</a>
            </li>
            @endguest

            @guest
            <li class="nav-item">
                <a class="nav-link font-sm" href="{{route('login')}}">ログイン</a>
            </li>
            @endguest
        </ul>
    </nav>
</div>
<div class="container">
    <div class="card password-reset-email-body">
        <div class="card-body">
            <h2 class="card-title password-reset-email-title font-md">-パスワード再設定-</h2>

            @include('error_list')

            @if (session('status'))
            <div class="card-text alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="card-text">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <label for="email" class="font-sm password-reset-email-text">-メールアドレス-</label>
                    <div class="md-form font-sm password-reset-email-form">
                        <input class="form-control" type="text" id="email" name="email" required>
                    </div>

                    <button class="btn btn-block password-reset-email-button font-sm" type="submit">メール送信</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection