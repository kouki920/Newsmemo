@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="sticky-top">
    <nav class="navbar navbar-expand navbar-dark blue-gradient">
        <a class="navbar-brand" href="{{route('news.default_index')}}"><i class="far fa-sticky-note mr-1"></i>Newsmemo</a>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">ユーザー登録</a>
            </li>
            @endguest

            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">ログイン</a>
            </li>
            @endguest
        </ul>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">パスワード再設定</h2>

                    @include('error_list')

                    @if (session('status'))
                    <div class="card-text alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card-text">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="md-form">
                                <label for="email">メールアドレス</label>
                                <input class="form-control" type="text" id="email" name="email" required>
                            </div>

                            <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">メール送信</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection