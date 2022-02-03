<?php

namespace App\Services\Tag;

use App\Models\Article;
use App\Models\Tag;
use App\Repositories\Tag\TagRepositoryInterface;
use Illuminate\Support\Collection;

class TagService implements TagServiceInterface
{
    private TagRepositoryInterface $tagRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    /**
     * タグ入力時に予測変換を表示させる
     * Vue Tags Inputでは、タグ名に対しtextというキーが付いている必要があるのでmapメソッドを使用して同様の連想配列を作成
     *
     * @return array
     */
    public function getAllTagNames(): Collection
    {
        $allTags = $this->tagRepository->getAll();

        return $allTags->map(function ($tag) {
            return ['text' => $tag->name];
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getTagNamesOfArticle(Article $article): Collection
    {
        return $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
    }

    /**
     * タグ名指定でデータを取得する
     *
     * @param \App\Models\Tag $tag
     * @param string $name
     * @return object
     */
    public function getTagData(Tag $tag, string $name)
    {
        $tag = $this->tagRepository->getTagData($tag, $name);

        return $tag;
    }

    /**
     * タグに属するメモデータを取得
     *
     * @param \App\Models\Tag $tag
     * @return array
     */
    public function getTagArticle(Tag $tag)
    {
        $articles = $this->tagRepository->getTagArticle($tag);

        return $articles;
    }
}
