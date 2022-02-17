<div class="card collection-body">
    <div class="card-body collection-body__content">
        <a href="{{ route('collections.show', ['name' => $collection->name,'id' => Auth::id()]) }}" class="card-title collection-body__name font-sm">
            {{ $collection->name }}
        </a>
        <!-- dropdown -->
        <div class="card-text collection-body__edit-button">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-link collection-body__edit-button-icon">
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
        <!-- 更新 modal -->
        <div id="modal-edit-{{ $collection->id }}" class="modal fade collection-body__update-modal" tabindex="-1" role="dialog">
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
                        <div class="modal-body collection-body__update-modal-content">
                            <div class="collection-body__update-modal-text font-sm">
                                コレクション名を編集してください
                            </div>
                            <div class="form-group collection-body__update-modal-button-list">
                                <input class="form-control font-sm" type="text" name="name" value="{{$collection->name ?? old('name')}}">
                                <div class="modal-footer collection-body__update-modal-button-content">
                                    <a class="btn collection-body__cancel-button font-sm" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn collection-body__update-button font-sm">更新</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- 削除modal -->
        <div id="modal-delete-{{ $collection->id }}" class="modal fade collection-body__delete-modal" tabindex="-1" role="dialog">
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
                        <div class="modal-body collection-body__delete-modal-text font-sm">
                            コレクションを削除しますか?
                        </div>
                        <div class="modal-footer collection-body__delete-modal-button-content justify-content-between">
                            <a class="btn collection-body__cancel-button font-sm" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn collection-body__delete-button font-sm">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>
</div>