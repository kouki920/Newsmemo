<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function getArticleIndex(Article $article, $request);

    public function getArticleRanking(Article $article);
}
