@extends('app')

@section('title','ユーザー登録')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">プロフィールの編集</h2>

                    @include('error_list')

                    <div class="card-text">
                        <form action="{{route('users.update',['name' => $user->name])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name ?? old('name')}}">
                                <small class="text-muted ">※半角英数字8~16文字以内で入力して下さい</small>
                            </div>
                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email ?? old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="introduction">自己紹介
                                    <small class="blue-grey-text">（200文字以内）</small>
                                </label>
                                <textarea name="introduction" class="form-control" id="introduction" cols="3" rows="3">{{$user->introduction ?? old('introduction')}}</textarea>
                            </div>
                            <div class='btn-toolbar' role="toolbar">
                                <div>
                                    <a href="{{route('users.show',['name' => $user->name])}}"><button class="btn blue-gradient mt-2 mb-2" type="submit">キャンセル</button></a>
                                    <button class="btn blue-gradient mt-2 mb-2" type="submit">更新</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection