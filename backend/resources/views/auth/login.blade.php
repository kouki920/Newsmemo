@extends('app')

@section('title','ログイン')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>

<div class="container">
    <div class="logo-body">
        <img src="{{asset('/assets/images/Newsmemo_logo.png')}}" alt="logo" class="logo-body__img">
    </div>
    <div class="login-header-body">
        <p class="login-header-body__title font-lg">-&ensp;Login&ensp;-</p>
    </div>
    <div class="card login-body">
        <div class="card-text">
            @include('error_list')
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="login-body__item font-md" for="email">-&ensp;e-mail&ensp;-</label>
                <div class="md-form login-body__form">
                    <input class="login-body__form-content font-sm" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <label class="login-body__item font-md" for="password">-&ensp;password&ensp;-</label>
                <div class="md-form login-body__form">
                    <input class="login-body__form-content font-sm" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <div class="password-setting-link">
                    <a href="{{ route('password.request') }}" class="card-text password-setting-link__text font-sm">※パスワードを忘れた場合</a>
                </div>

                <button class="login-button font-sm" type="submit">
                    <p class="login-button__text font-sm">ログイン</p>
                </button>

                <button class="login-button">
                    <a href="{{ route('login.guest') }}" class="login-button__text font-sm">{{ __('ゲストログイン') }}</a>
                </button>

            </form>

            <div class="user-register-button">
                <a href="{{ route('register') }}" class="btn-block card-text user-register-button__text font-sm">新規登録</a>
            </div>
        </div>
    </div>
    <div class="subtitle-body">
        <img src="{{asset('/assets/images/Newsmemo_subtitle.png')}}" alt="logo" class="subtitle-body__img">
    </div>
    <div class="login-introduction-body">
        <div class="login-introduction-body__text">
            <p class="font-md">
                本サービスは、世の中に対する日々の気づきを記録するサービスです。
                <br>
                ビジネスマンから学生まで、誰でも簡単にご利用いただけます。
                <br>
                まずは会員登録から始めましょう！
            </p>
            <p class="font-sm login-introduction-body__text--mute">
                ※このサービスは、ポートフォリオ用に制作しているものである為
                <br>
                現段階では定期的にデータを更新しております。
                <br>
                予めご了承ください。
            </p>
        </div>
    </div>
    <div class="fixed-bottom">
        @include('articles.footer')
    </div>
</div>
@endsection