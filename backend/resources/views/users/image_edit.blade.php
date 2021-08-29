@extends('app')

@section('title','ユーザー登録')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center font-lr">-ユーザーアイコンの編集-</h2>

                    @include('error_list')

                    <div class="card-text">
                        <form action="{{route('users.image_update',['name' => $user->name])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="image" class="font-sm">プロフィール画像を選択して下さい</label>
                                <input type="file" class="form-control font-sm" id="image" name="image" value="{{$user->image}}">
                            </div>
                            <input type="hidden" class="form-control" id="email" name="email" value="{{$user->email}}">
                            <input type="hidden" class="form-control" id="name" name="name" value="{{$user->name}}">
                            <div class='btn-toolbar float-right' role="toolbar">
                                <button class="btn user-profile-update-button font-sm" type="submit">更新</button>
                            </div>
                        </form>
                        <a href="{{route('users.show',['name' => $user->name])}}"><button class="btn user-profile-cancel-button font-sm float-left" type="submit">キャンセル</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom">
    @include('articles.footer')
</div>

@endsection