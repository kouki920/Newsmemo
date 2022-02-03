<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\Tag\TagServiceInterface;

class TagController extends Controller
{
    private TagServiceInterface $tagService;

    public function __construct(
        TagServiceInterface $tagService
    ) {
        $this->tagService = $tagService;
    }

    /**
     * タグに属する投稿の表示
     *
     * @param \App\Models\Tag $tag
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(Tag $tag, string $name)
    {
        // タグデータを取得
        $tag = $this->tagService->getTagData($tag, $name);

        // タグに属する投稿データを取得
        $articles = $this->tagService->getTagArticle($tag);

        return view('tags.show', compact('tag', 'articles'));
    }
}
