<?php

namespace App\Repositories\Collection;

use App\Models\Collection;
use App\Models\Article;

interface CollectionRepositoryInterface
{
    public function getCollectionIndex(Collection $collection, $id);

    public function registerCollection(Article $article, $collections);

    public function getCollectionData($collection, string $name, $id);

    public function getCollectionArticleData($collections);
}
