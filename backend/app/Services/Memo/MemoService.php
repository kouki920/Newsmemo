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

    public function store($memo, $request, $memoRecord)
    {
        $this->memoRepository->store($memo, $request, $memoRecord);
    }
}
