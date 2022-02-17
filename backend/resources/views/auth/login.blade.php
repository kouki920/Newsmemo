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
    <div class="app-introduction-body">
        <div class="app-introduction-body__text">
            <p class="font-md">
                本サービスは、世の中に対する日々の気づきを記録するサービスです。
                <br>
                社会人の方や学生の方も、誰でも簡単にご利用いただけます。
                <br>
                まずは会員登録から始めましょう！
            </p>
            <p class="font-sm app-introduction-body__text--mute">
                ※このサービスは、ポートフォリオ用に制作しているものである為
                <br>
                現段階では定期的にデータを更新しております。
                <br>
                予めご了承ください。
            </p>
        </div>
    </div>
    <div class="app-guide-body">
        <p class="app-guide-body__title font-lg">-&ensp;What&ensp;about&ensp;Newsmemo&ensp;-</p>
    </div>
    <div class="app-image-body">
        <div class="app-image-body__text">
            <p class="font-md">
                会員登録後、下記の機能をご利用いただけます。
            </p>
            <p class="font-sm app-image-body__text--mute">
                ※このサービスは、ポートフォリオ用に制作しているものである為
                <br>
                機能を追加・修正する可能性がございます。
                <br>
                予めご了承ください。
            </p>
        </div>
    </div>
    <div class="app-function-body">
        <div class="app-function-body__box">
            <div class="app-function-body__content">
                <h3><span class="app-function-body__title font-md">-&ensp;最新のニュースが読める&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/news960.png')}}">
                <p class="font-sm app-function-body__text">様々なサイトのニュースを読むことができます。</p>
            </div>
            <div class="app-function-body__content">
                <h3><span class="app-function-body__title font-md">-&ensp;タグ機能で投稿を管理&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/tag960.png')}}">
                <p class="font-sm app-function-body__text">タグ機能で投稿をタグ別で検索できます。</p>
            </div>
            <div class="app-function-body__content three">
                <h3><span class="app-function-body__title font-md">-&ensp;気になる人をフォロー&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/follow960.png')}}">
                <p class="font-sm app-function-body__text">気になるユーザーをフォローできます。</p>
            </div>
        </div>
        <div class="app-function-body__box--two">
            <div class="app-function-body__content">
                <h3><span class="app-function-body__title font-md">-&ensp;ニュースから得た知識を記録&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/profile960.png')}}">
                <p class="font-sm app-function-body__text">ニュースで得た知識を記録することができます。</p>
            </div>
            <div class="app-function-body__content">
                <h3><span class="app-function-body__title font-md">-&ensp;知識に対するアウトプットを記録&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/output960.png')}}">
                <p class="font-sm app-function-body__text">知識に対する自分なりのアウトプットを記録できます。</p>
            </div>
            <div class="app-function-body__content">
                <h3><span class="app-function-body__title font-md">-&ensp;コレクション機能で投稿を管理&ensp;-</span></h3>
                <img class="app-function-body__image" src="{{asset('/assets/images/collection960.png')}}">
                <p class="font-sm app-function-body__text">コレクション機能で投稿をジャンルごとに管理できます。</p>
            </div>
        </div>
    </div>
    <div class="app-footer-body">
        <!-- Copyright -->
        <div class="app-footer-body__text font-sm">
            © 2021 Copyright:
            <i class="far fa-sticky-note fa-fw"></i>Newsmemo
        </div>
        <!-- Copyright -->
    </div>
</div>
@endsection