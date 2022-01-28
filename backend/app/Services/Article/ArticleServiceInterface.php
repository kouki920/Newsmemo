<?php

namespace App\Services\Article;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleServiceInterface
{
    public function store(Article $article, array $articleRecord, Collection $tags);

    public function update(Article $article, array $articleRecord, Collection $tags);

    public function delete(Article $article);

    public function getArticleRanking(Article $article);

    public function getArticleIndex(Article $article, $request);

    public function getMemoData(Article $article);
}
