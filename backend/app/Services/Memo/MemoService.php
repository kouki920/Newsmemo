<?php

namespace App\Services\Memo;

use App\Models\Memo;
use App\Repositories\Memo\MemoRepositoryInterface;
use Illuminate\Support\Collection;

class MemoService implements MemoServiceInterface
{
    private MemoRepositoryInterface $memoRepository;

    public function __construct(
        MemoRepositoryInterface $memoRepository
    ) {
        $this->memoRepository = $memoRepository;
    }

    /**
     * マインドマップの登録
     *
     * @param array $memoRecord
     * @param int $articleId
     */
    public function store(array $memoRecord, int $articleId)
    {
        $this->memoRepository->store($memoRecord, $articleId);
    }

    /**
     * マインドマップの更新
     *
     * @param \App\Models\Memo $memo
     * @param array $memoRecord
     */
    public function update(Memo $memo, array $memoRecord)
    {
        $this->memoRepository->update($memo, $memoRecord);
    }

    /**
     * マインドマップの削除
     *
     * @param \App\Models\Memo $memo
     */
    public function delete(Memo $memo)
    {
        $this->memoRepository->delete($memo);
    }
}
