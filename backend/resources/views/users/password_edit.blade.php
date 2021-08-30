@extends('app')

@section('title', '設定')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="password-reset-body">
        <div class="card">
            <div class="card-body">
                <div class="card-title font-md">-パスワードの変更-</div>

                @include('error_list')
                <div class="card-body">
                    <form method="post" action="{{route('users.update_password',['name' => Auth::user()->name])}}">
                        @csrf
                        <div class="form-group font-sm">
                            <label for="current">現在のパスワード</label>
                            <div>
                                <input id="current" type="password" class="form-control password-edit-form" name="current_password" required autofocus>
                            </div>
                        </div>
                        <div class="form-group font-sm">
                            <label for="password">新しいのパスワード</label>
                            <div>
                                <input id="password" type="password" class="form-control password-edit-form" name="new_password" required>
                            </div>
                        </div>
                        <div class="form-group font-sm">
                            <label for="confirm">新しいのパスワード（確認用）</label>
                            <div>
                                <input id="confirm" type="password" class="form-control password-edit-form" name="new_password_confirmation" required>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn password-edit-button">変更</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection