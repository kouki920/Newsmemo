<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Article $article): void
    {
        $article->delete();
    }
}
