<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function getArticleIndex(Article $article, $request);

    public function getArticleRanking(Article $article);

    public function store(array $articleRecord);

    public function update(Article $article, array $articleRecord);

    public function delete(Article $article);

    public function attachTags(Article $article, Collection $tags): void;

    public function registerNewsLink(Article $article, array $articleRecord): void;

    public function getMemoData(Article $article);

    public function getRecentTags($id);
}
