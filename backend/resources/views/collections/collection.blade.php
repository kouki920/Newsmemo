<div class="card mt-3 col-6">
    <div class="card-body d-flex flex-row">
        <a href="{{ route('collections.show', ['name' => $collection->name,'id' => Auth::id()]) }}" class="text-muted text-decoration-none">
            <p id="collection-name" class="card-title m-1 p-1">{{ $collection->name }}</p>
        </a>
        <!-- dropdown -->
        <div class="ml-auto card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link text-muted m-1 p-1">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-edit-{{ $collection->id }}">
                        <i class=" fas fa-pen mr-1"></i>コレクション名を編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $collection->id }}">
                        <i class="fas fa-trash-alt mr-1"></i>コレクションを削除
                    </a>
                </div>
            </div>
        </div>
        <!-- dropdown -->
        <!-- 非同期 更新 modal -->
        <div id="modal-edit-{{ $collection->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('collections.update',['id' => Auth::id(),'collection'=> $collection]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body text-center">
                            コレクション名を編集してください
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" value="{{$collection->name ?? old('name')}}">
                                <div class="modal-footer justify-content-between">
                                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn btn-success">更新</button>
                                </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal -->
<!-- modal -->
<div id="modal-delete-{{ $collection->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('collections.destroy',['id' => Auth::id(),'collection'=> $collection]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    コレクションを削除しますか?
                </div>
                <div class="modal-footer justify-content-between">
                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                    <button type="submit" class="btn btn-danger">削除する</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
</div>
</div>