<?php

namespace App\Services\Article;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Support\Collection;

interface ArticleServiceInterface
{
    public function getArticleRanking(Article $article);

    public function getArticleIndex(Article $article, $request);
}
