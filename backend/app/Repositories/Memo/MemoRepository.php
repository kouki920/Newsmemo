<?php

namespace App\Repositories\Memo;

use App\Models\Memo;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class MemoRepository implements MemoRepositoryInterface
{
    private Memo $memo;

    public function __construct(Memo $memo)
    {
        $this->memo = $memo;
    }

    /**
     * マインドマップの登録
     *
     * @param array $memoRecord
     * @param int $articleId
     */
    public function store(array $memoRecord, int $articleId)
    {
        $this->memo->article_id = $articleId;
        $this->memo->fill($memoRecord)->save();
    }

    /**
     * マインドマップの更新
     *
     * @param \App\Models\Memo $memo
     * @param array $memoRecord
     */
    public function update(Memo $memo, array $memoRecord)
    {
        $memo->fill($memoRecord)->save();
    }

    /**
     * マインドマップの削除
     *
     * @param \App\Models\Memo $memo
     */
    public function delete(Memo $memo)
    {
        $memo->delete();
    }
}
