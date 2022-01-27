<?php

namespace App\Services\NewsLink;

use App\Models\NewsLink;
use App\Repositories\NewsLink\NewsLinkRepository;
use App\Repositories\NewsLink\NewsLinkRepositoryInterface;
use Illuminate\Support\Collection;

class NewsLinkService implements NewsLinkServiceInterface
{
    private NewsLinkRepositoryInterface $newsLinkRepository;

    public function __construct(
        NewsLinkRepositoryInterface $newsLinkRepository
    ) {
        $this->newsLinkRepository = $newsLinkRepository;
    }

    /**
     * よく読まれているニュースを取得(過去30日間)
     *
     * @return array
     */
    public function getNewsRanking(NewsLink $newsLink)
    {
        return $this->newsLinkRepository->getNewsRanking($newsLink);
    }
}
