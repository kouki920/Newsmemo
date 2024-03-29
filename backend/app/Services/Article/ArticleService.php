<?php

namespace App\Services\Article;

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


    /**
     * 投稿の登録
     * 外部API(NEW API)で取得したnewsへのリンク先とタイトルをnews_linksテーブルに保存
     * 投稿に関するタグの登録、投稿とタグの紐付けを実行
     *
     * @param array $articleRecord
     * @param \Illuminate\Support\Collection $tags
     */
    public function store(array $articleRecord, Collection $tags)
    {
        $article = $this->articleRepository->store($articleRecord);

        // タグの登録、投稿とタグの紐付けを実行
        $this->articleRepository->attachTags($article, $tags);

        $this->articleRepository->registerNewsLink($article, $articleRecord);
    }


    /**
     * 投稿の更新とタグの更新
     *
     * @param \App\Models\Article $article
     * @param array $articleRecord
     * @param \Illuminate\Support\Collection $tags
     */
    public function update(Article $article, array $articleRecord, Collection $tags)
    {
        $this->articleRepository->update($article, $articleRecord);

        $this->articleRepository->attachTags($article, $tags);
    }

    /**
     * 投稿の削除
     *
     * @param \App\Models\Article $article
     */
    public function delete(Article $article)
    {
        $this->articleRepository->delete($article);
    }

    /**
     * 一覧表示するためにarticlesテーブルからデータを取得する
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return array
     */
    public function getArticleIndex(Article $article, $request)
    {
        return $this->articleRepository->getArticleIndex($article, $request);
    }


    /**
     * 投稿のランキングデータの取得(過去30日間)
     *
     * @param \App\Models\Article $article
     * @return array
     */
    public function getArticleRanking(Article $article)
    {
        return $this->articleRepository->getArticleRanking($article);
    }


    /**
     * 投稿に関するメモ(マインドマップ)データを取得する
     *
     * @param \App\Models\Article $article
     */
    public function getMemoData(Article $article)
    {
        return $this->articleRepository->getMemoData($article);
    }

    /**
     * 最近使用したタグを取得する
     *
     * @param int $id
     */
    public function getRecentTags($id)
    {
        return $this->articleRepository->getRecentTags($id);
    }
}
