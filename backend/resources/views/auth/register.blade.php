@extends('app')

@section('title','ユーザー登録')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>
<div class="container">
    <div class="card register-form-body">
        <div class="card-body">
            <h2 class="card-title register-form-title font-lg">-ユーザー登録-</h2>

            @include('error_list')

            <div class="card-text">
                <form action="{{route('register')}}" method="POST" novalidate="novalidate">
                    @csrf

                    <div class="register-name-body">
                        <label for="name" class="font-sm register-name-text">-お名前-</label>
                        <div class="md-form font-sm register-name-form">
                            <input type="text" class="form-control font-sm" id="name" name="name" value="{{old('name')}}" required>
                            <p>※半角英数字8~16文字以内で入力して下さい</p>
                        </div>
                    </div>

                    <div class="register-email-body">
                        <label for="email" class="font-sm register-email-text">-メールアドレス-</label>
                        <div class="md-form font-sm register-email-form">
                            <input type="email" class="form-control font-sm" id="email" name="email" value="{{old('email')}}" required>
                        </div>
                    </div>

                    <div class="register-password-body">
                        <label for="password" class="font-sm register-password-text">-パスワード-</label>
                        <div class="md-form font-sm register-password-form">
                            <input type="password" class="form-control font-sm" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="register-password-confirmation-body">
                        <label for="password_confirmation" class="font-sm register-password-confirmation-text">-パスワード(再確認)-</label>
                        <div class="md-form font-sm register-password-confirmation-form">
                            <input type="password" class="form-control font-sm" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="user-register-button-body">
                        <button class="btn btn-block user-register-button font-sm" type="submit">登録</button>
                    </div>
                </form>

                <div class="register-login-button-body">
                    <a href="{{ route('login') }}" class="btn btn-block register-login-link-button font-sm">ログインはこちら</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection