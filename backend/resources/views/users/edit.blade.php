@extends('app')

@section('title','ユーザー登録')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => true])
</div>
<div class="container">
    <div class="card user-profile-edit-body">
        <div class="card-body">
            <div class="card-title font-md">-プロフィールの編集-</div>

            @include('error_list')
            @if (Auth::id() == config('user.guest_user_id'))
            <p class="user-profile-edit-body__caution-text font-sm">
                <b>※ゲストユーザーは、以下を編集できません。</b><br>
                ・ユーザー名<br>
                ・メールアドレス<br>
            </p>
            @endif
            <div class="card-text">
                <form action="{{route('users.update',['name' => $user->name])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">
                            <small class="font-sm">-お名前（25文字以内）-</small>
                        </label>
                        @if (Auth::id() == config('user.guest_user_id'))
                        <input type="text" class="form-control font-sm" id="name" name="name" value="{{$user->name}}" readonly>
                        @else
                        <input type="text" class="form-control font-sm" id="name" name="name" value="{{$user->name ?? old('name')}}">
                        @endif
                        <small class="font-sm">※半角英数字8~16文字以内で入力して下さい</small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-sm">-メールアドレス-</label>
                        @if (Auth::id() == config('user.guest_user_id'))
                        <input type="text" class="form-control font-sm" id="email" name="email" value="{{$user->email}}" readonly>
                        @else
                        <input type="text" class="form-control font-sm" id="email" name="email" value="{{$user->email ?? old('email')}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="introduction">
                            <small class="font-sm">-自己紹介（200文字以内）-</small>
                        </label>
                        <textarea name="introduction" class="form-control font-sm" id="introduction" cols="3" rows="3">{{$user->introduction ?? old('introduction')}}</textarea>
                    </div>
                    <div class='btn-toolbar float-right' role="toolbar">
                        <button class="btn user-profile-edit-body__update-button font-sm" type="submit">更新</button>
                    </div>
                </form>
                <a href="{{route('users.show',['name' => $user->name])}}"><button class="btn float-left user-profile-edit-body__cancel-button font-sm" type="submit">キャンセル</button></a>
            </div>
        </div>
    </div>
</div>
@endsection