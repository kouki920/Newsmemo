<?php

namespace App\Repositories\Memo;

use App\Models\Memo;
use Illuminate\Support\Collection;

interface MemoRepositoryInterface
{
    public function store(array $memoRecord, int $articleId);

    public function update(Memo $memo, array $memoRecord);

    public function delete(Memo $memo);
}
