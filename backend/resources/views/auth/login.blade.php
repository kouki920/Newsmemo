@extends('app')

@section('title','ログイン')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>

<div class="container">
    <div class="card login-body text-center">
        <p class="card-title login-title font-lg">Login</p>
        <div class="card-text">
            @include('error_list')
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="login-item font-md" for="email">-&ensp;e-mail&ensp;-</label>
                <div class="md-form">
                    <input class="form-control login-form-content font-sm" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <label class="login-item font-md" for="password">-&ensp;password&ensp;-</label>
                <div class="md-form login-form">
                    <input class="form-control login-form-content font-sm" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <div class="text-left login-password-forget">
                    <a href="{{ route('password.request') }}" class="card-text login-password-forget-text font-sm">パスワードを忘れた方</a>
                </div>

                <button class="btn btn-block login-button font-md" type="submit">ログイン</button>

                <button class="btn btn-block login-button">
                    <a href="{{ route('login.guest') }}" class="login-button-text font-md">{{ __('ゲストログイン') }}</a>
                </button>

            </form>

            <div class="user-register-button">
                <a href="{{ route('register') }}" class="btn-block card-text user-register-button-text font-md">ユーザー登録はこちら</a>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        @include('articles.footer')
    </div>
</div>
@endsection