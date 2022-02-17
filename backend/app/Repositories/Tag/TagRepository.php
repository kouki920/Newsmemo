<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use Illuminate\Support\Collection;

class TagRepository implements TagRepositoryInterface
{
    private Tag $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * {@inheritDoc}
     */
    public function findByName(string $tagName)
    {
        $this->tag
            ->where('name', $tagName)
            ->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(): Collection
    {
        return $this->tag->all();
    }

    /**
     * {@inheritDoc}
     */
    public function getMainTags(): Collection
    {
        return $this->tag
            ->whereIn('name', config('tag.main'))
            ->get();
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
        return $tag->where('name', $name)->first();
    }

    /**
     * タグに属するメモデータを取得
     *
     * @param \App\Models\Tag $tag
     * @return array
     */
    public function getTagArticle(Tag $tag)
    {
        return $tag->articles->sortByDesc('created_at')->paginate(10);
    }
}
