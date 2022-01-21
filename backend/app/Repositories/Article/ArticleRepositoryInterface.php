<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\User;

interface ArticleRepositoryInterface
{

    public function delete(Article $article): void;
}
