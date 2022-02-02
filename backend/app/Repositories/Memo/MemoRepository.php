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
     * @param \App\Http\Requests\Memo\StoreRequest $request
     * @param \App\Models\Memo $memo
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store($memo, $request, $memoRecord)
    {
        $memo->article_id = $request->article_id;
        $memo->fill($memoRecord)->save();
    }
}
