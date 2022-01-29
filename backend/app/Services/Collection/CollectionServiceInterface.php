<?php

namespace App\Services\Collection;

use App\Models\Collection;

interface CollectionServiceInterface
{
    public function getCollectionIndex(Collection $collection, $id);
}
