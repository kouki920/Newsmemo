<?php

namespace App\Providers;

use App\Services\Article\ArticleService;
use App\Services\Article\ArticleServiceInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Tag\TagService;
use App\Services\Tag\TagServiceInterface;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Services\NewsLink\NewsLinkService;
use App\Services\NewsLink\NewsLinkServiceInterface;
use App\Repositories\NewsLink\NewsLinkRepository;
use App\Repositories\NewsLink\NewsLinkRepositoryInterface;
use App\Services\Collection\CollectionService;
use App\Services\Collection\CollectionServiceInterface;
use App\Repositories\Collection\CollectionRepository;
use App\Repositories\Collection\CollectionRepositoryInterface;
use App\Services\Contact\ContactService;
use App\Services\Contact\ContactServiceInterface;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Services\Memo\MemoService;
use App\Services\Memo\MemoServiceInterface;
use App\Repositories\Memo\MemoRepository;
use App\Repositories\Memo\MemoRepositoryInterface;
use App\Services\API\CovidNewsService;
use App\Services\API\CovidNewsServiceInterface;
use App\Services\API\HeadlineNewsService;
use App\Services\API\HeadlineNewsServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(TagServiceInterface::class, TagService::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(NewsLinkServiceInterface::class, NewsLinkService::class);
        $this->app->bind(NewsLinkRepositoryInterface::class, NewsLinkRepository::class);
        $this->app->bind(CollectionServiceInterface::class, CollectionService::class);
        $this->app->bind(CollectionRepositoryInterface::class, CollectionRepository::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(MemoServiceInterface::class, MemoService::class);
        $this->app->bind(MemoRepositoryInterface::class, MemoRepository::class);
        $this->app->bind(CovidNewsServiceInterface::class, CovidNewsService::class);
        $this->app->bind(HeadlineNewsServiceInterface::class, HeadlineNewsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page', $queryParams = []) {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                    'query' => $queryParams
                ]
            );
        });
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        };
    }
}
