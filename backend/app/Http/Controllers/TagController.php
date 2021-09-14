<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * タグに属する投稿の表示
     *
     * @param \App\Models\Tag $tag
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(Tag $tag, string $name)
    {
        $tag = $tag->getTagData($name);

        $articles = $tag->getTagArticle();

        return view('tags.show', compact('tag', 'articles'));
    }
}
