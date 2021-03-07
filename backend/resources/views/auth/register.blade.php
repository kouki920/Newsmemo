@extends('app')

@section('title','ユーザー登録')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h1 class="text-center"><a class="text-dark" href="/article">syokumane</a></h1>
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2>

                    @include('error_list')

                    <div class="card-text">
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="md-form">
                                <label for="name">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                                <small class="text-muted ">※半角英数字8~16文字以内で入力して下さい</small>
                            </div>
                            <div class="md-form">
                                <label for="email">メールアドレス</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                            </div>
                            <div class="md-form">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="md-form">
                                <label for="password_confirmation">パスワード(再確認)</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">登録</button>
                        </form>

                        <div class="mt-0">

                            <a href="{{ route('login') }}" class="btn btn-block blue-gradient text-white mt-2 mb-2">ログインはこちら</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection