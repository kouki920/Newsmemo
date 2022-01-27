<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function getArticleIndex(Article $article, $request);

    public function getArticleRanking(Article $article);

    public function store(Article $article, array $articleRecord);

    public function attachTags(Article $article, Collection $tags): void;

    public function registerNewsLink($articleData, array $articleRecord): void;

    public function getMemoData(Article $article);
}
