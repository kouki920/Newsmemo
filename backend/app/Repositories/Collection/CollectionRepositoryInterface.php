<?php

namespace App\Repositories\Collection;

use App\Models\Collection;

interface CollectionRepositoryInterface
{
    public function getCollectionIndex(Collection $collection, $id);
}
