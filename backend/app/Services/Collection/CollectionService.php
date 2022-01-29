<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Repositories\Collection\CollectionRepositoryInterface;

class CollectionService implements CollectionServiceInterface
{
    private CollectionRepositoryInterface $collectionRepository;

    public function __construct(
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->collectionRepository = $collectionRepository;
    }


    /**
     * コレクション名の一覧を取得
     * 引数の$idでログインユーザーのidを受け取る
     *
     * @param int $id
     * @return array
     */
    public function getCollectionIndex(Collection $collection, $id)
    {
        return $this->collectionRepository->getCollectionIndex($collection, $id);
    }
}
