<?php

namespace App\Repositories\Collection;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Builder;

class CollectionRepository implements CollectionRepositoryInterface
{
    /**
     * コレクション名の一覧を取得
     * 引数の$idでログインユーザーのidを受け取る
     *
     * @param int $id
     * @return array
     */
    public function getCollectionIndex(Collection $collection, $id)
    {
        return $collection->where('user_id', $id)->latest()->get();
    }
}
