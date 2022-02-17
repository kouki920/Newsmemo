<?php

namespace App\Repositories\NewsLink;

use App\Models\NewsLink;
use App\Models\User;
use Illuminate\Support\Collection;

interface NewsLinkRepositoryInterface
{
    public function getNewsRanking(NewsLink $newsLink);
}
