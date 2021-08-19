@extends('app')

@section('title','ログイン')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>

<div class="container">
    <div class="card login-body text-center">
        <p class="card-title login-title font-lg">ログイン</p>
        <div class="card-text">
            @include('error_list')
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="login-content font-md" for="email">メールアドレス</label>
                <div class="md-form">
                    <input class="form-control login-form-content font-sm" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <label class="login-content font-md" for="password">パスワード</label>
                <div class="md-form login-form">
                    <input class="form-control login-form-content font-sm" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <div class="text-left">
                    <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                </div>

                <button class="btn btn-block mt-2 mb-2" type="submit">ログイン</button>

                <button class="btn btn-block mt-2 mb-2">
                    <a href="{{ route('login.guest') }}" class="text-decoration-none">{{ __('ゲストログイン') }}</a>
                </button>

            </form>

            <div class="mt-0">
                <a href="{{ route('register') }}" class="btn btn-block mt-2 mb-2 card-text">ユーザー登録はこちら</a>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        @include('articles.footer')
    </div>
</div>
@endsection