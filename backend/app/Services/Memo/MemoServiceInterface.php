<?php

namespace App\Services\Memo;

use App\Models\Memo;
use Illuminate\Support\Collection;

interface MemoServiceInterface
{
    public function store($memo, $request, $memoRecord);
}
