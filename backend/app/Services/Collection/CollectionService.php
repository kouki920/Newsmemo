<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Models\Article;
use App\Repositories\Collection\CollectionRepositoryInterface;

class CollectionService implements CollectionServiceInterface
{
    private CollectionRepositoryInterface $collectionRepository;

    public function __construct(
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->collectionRepository = $collectionRepository;
    }


    /**
     * コレクション名の一覧を取得
     * 引数の$idでログインユーザーのidを受け取る
     *
     * @param int $id
     * @return array
     */
    public function getCollectionIndex(Collection $collection, $id)
    {
        return $this->collectionRepository->getCollectionIndex($collection, $id);
    }

    /**
     * コレクションを非同期処理で保存する
     *
     * @param \App\Models\Article $article
     */
    public function registerCollection(Article $article, $collections)
    {
        $this->collectionRepository->registerCollection($article, $collections);
    }

    /**
     * コレクションデータを取得する
     */
    public function getCollectionData($collection, string $name, $id)
    {
        // リクエストフォームで送られてきた$nameと$idに一致するcollectionデータを取得
        return $this->collectionRepository->getCollectionData($collection, $name, $id);
    }

    public  function getCollectionArticleData($collections)
    {
        // $nameと$idに一致するコレクションデータに属するarticlesデータを取得
        $articles = $this->collectionRepository->getCollectionArticleData($collections);

        return $articles;
    }
}
