<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        $articles = $tag->articles->sortByDesc('created_at')->paginate(10);

        session()->flash('msg_success', 'タグ別で投稿を取得しました');
        return view('tags.show', compact('tag', 'articles'));
    }
}
