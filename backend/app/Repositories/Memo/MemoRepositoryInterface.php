<?php

namespace App\Repositories\Memo;

use App\Models\Memo;
use Illuminate\Support\Collection;

interface MemoRepositoryInterface
{
    public function store($memo, $request, $memoRecord);
}
