@extends('app')

@section('title', '設定')

@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <ul class="list-group mt-3">
        <li class="list-group-item bg-info">設定</li>
    </ul>
    <div class="list-group">
        <a href="{{ route('users.edit_password',['name' => Auth::user()->name]) }}" class="list-group-item list-group-item-action py-3"><i class="fas fa-unlock-alt fa-fw mr-3"></i>パスワードの変更</a>
        <a href="#" class="list-group-item list-group-item-action py-3"><i class="fas fa-envelope fa-fw mr-3"></i>お問い合わせ</a>
        <a href="{{ route('setting.agreement') }}" class="list-group-item list-group-item-action py-3"><i class="fas fa-book-open fa-fw mr-3"></i>利用規約</a>
        @if( Auth::id() != config('user.guest_user_id'))
        <a class="list-group-item list-group-item-action py-3 dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ Auth::user()->name }}">
            <i class="fas fa-user-times fa-fw mr-3"></i>退会する&ensp;※復元不可
        </a>
        <!-- modal -->
        <div id="modal-delete-{{ Auth::user()->name }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('users.destroy',['name' => Auth::user()->name]) }}" class="list-group-item list-group-item-action py-3">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            アカウント&ensp;{{ Auth::user()->name }}&ensp;を本当に削除しますか?
                            <br>
                            <i class="fas fa-exclamation-circle fa-fw"></i>注意&ensp;:&ensp;退会するとアカウントの復元はできません。
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">退会する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
        @endif
    </div>
</div>
@endsection