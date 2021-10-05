<div class="card collection-body">
    <div class="card-body collection-content">
        <a href="{{ route('collections.show', ['name' => $collection->name,'id' => Auth::id()]) }}" class="card-title collection-title font-sm">
            {{ $collection->name }}
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
                    <a class="dropdown-item edit-text font-sm" data-toggle="modal" data-target="#modal-edit-{{ $collection->id }}">
                        編集
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete-text font-sm" data-toggle="modal" data-target="#modal-delete-{{ $collection->id }}">
                        削除
                    </a>
                </div>
            </div>
        </div>
        <!-- dropdown -->
        <!-- 非同期 更新 modal -->
        <div id="modal-edit-{{ $collection->id }}" class="modal fade collection-update-body" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close collection-update-body-close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('collections.update',['id' => Auth::id(),'collection'=> $collection]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body collection-update-content">
                            <div class="collection-update-text font-sm">
                                コレクション名を編集してください
                            </div>
                            <div class="form-group collection-update-button-body">
                                <input class="form-control font-sm" type="text" name="name" value="{{$collection->name ?? old('name')}}">
                                <div class="modal-footer collection-update-button-content">
                                    <a class="btn collection-cancel-button font-sm" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn collection-update-button font-sm">更新</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        <div class="modal-body text-center font-sm">
                            コレクションを削除しますか?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn collection-cancel-button font-sm" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn collection-delete-button font-sm">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>
</div>