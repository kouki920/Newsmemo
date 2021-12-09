@extends('app')

@section('title','ユーザー登録')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>
<div class="container">
    <div class="card register-body">
        <div class="card-body">
            <h2 class="card-title register-body__title font-lg">-&ensp;ユーザー登録&ensp;-</h2>

            @include('error_list')

            <div class="card-text">
                <form action="{{route('register')}}" method="POST" novalidate="novalidate">
                    @csrf

                    <div class="register-body__name">
                        <label for="name" class="font-sm register-body__name-text">-&ensp;お名前&ensp;-</label>
                        <div class="md-form font-sm register-body__name-form">
                            <input type="text" class="form-control font-sm" id="name" name="name" value="{{old('name')}}" required>
                            <p class="font-sm register-body__name-text">※半角英数字8~16文字以内で入力して下さい</p>
                        </div>
                    </div>

                    <div class="register-body__email">
                        <label for="email" class="font-sm register-body__email-text">-&ensp;メールアドレス&ensp;-</label>
                        <div class="md-form font-sm register-body__email-form">
                            <input type="email" class="form-control font-sm" id="email" name="email" value="{{old('email')}}" required>
                        </div>
                    </div>

                    <div class="register-body__password">
                        <label for="password" class="font-sm register-body__password-text">-&ensp;パスワード&ensp;-</label>
                        <div class="md-form font-sm register-body__password-form">
                            <input type="password" class="form-control font-sm" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="register-body__password-confirmation">
                        <label for="password__confirmation" class="font-sm register-body__password-confirmation-text">-&ensp;パスワード(再確認)&ensp;-</label>
                        <div class="md-form font-sm register-body__password-confirmation-form">
                            <input type="password" class="form-control font-sm" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>


                    <div class="register-body__user-register-button">
                        <button class="btn btn-block register-body__user-register-button-body font-sm" type="submit">登録</button>
                    </div>
                </form>

                <div class="register-body__login-button">
                    <a href="{{ route('login') }}" class="btn btn-block register-body__login-button-body font-sm">ログインはこちら</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection