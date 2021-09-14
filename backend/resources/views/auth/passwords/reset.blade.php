@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="sticky-top">
    @include('nav')
</div>
<div class="container">
    <div class="card password-new-setting-body">
        <div class="card-body">
            <h2 class="card-title password-new-setting-title font-md">-新しいパスワードを設定-</h2>

            @include('error_list')

            <div class="card-text password-new-setting-text">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <label for="password" class="font-sm">-新しいパスワード-</label>
                    <div class="md-form password-new-setting-from">
                        <input class="form-control font-sm" type="password" id="password" name="password" required>
                    </div>

                    <label for="password_confirmation" class="font-sm">-新しいパスワード(再入力)-</label>
                    <div class="md-form password-new-setting-from">
                        <input class="form-control font-sm" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button class="btn btn-block password-new-setting-button" type="submit">送信</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection