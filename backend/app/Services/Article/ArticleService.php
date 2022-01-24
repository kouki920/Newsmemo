<?php

namespace App\Services\Article;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;
use Illuminate\Support\Collection;

class ArticleService implements ArticleServiceInterface
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository
    ) {
        $this->articleRepository = $articleRepository;
    }

    public function getArticleIndex(Article $article, $request)
    {
        return $this->articleRepository->getArticleIndex($article, $request);
    }

    /**
     * 投稿のランキングデータの取得(過去30日間)
     *
     * @return array
     */
    public function getArticleRanking(Article $article)
    {
        return $this->articleRepository->getArticleRanking($article);
    }
}
