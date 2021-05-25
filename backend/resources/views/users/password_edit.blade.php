@extends('app')

@section('title', '設定')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">パスワードの変更</h2>

                    @include('error_list')
                    <div class="card-body">
                        <form method="post" action="{{route('users.update_password',['name' => Auth::user()->name])}}">
                            @csrf
                            <div class="form-group">
                                <label for="current">現在のパスワード</label>
                                <div>
                                    <input id="current" type="password" class="form-control" name="current_password" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">新しいのパスワード</label>
                                <div>
                                    <input id="password" type="password" class="form-control" name="new_password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm">新しいのパスワード（確認用）</label>
                                <div>
                                    <input id="confirm" type="password" class="form-control" name="new_password_confirmation" required>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">変更</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection