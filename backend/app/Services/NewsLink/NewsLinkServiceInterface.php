<?php

namespace App\Services\NewsLink;

use App\Models\NewsLink;

interface NewsLinkServiceInterface
{
    public function getNewsRanking(NewsLink $newsLink);
}
