<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemoRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{

    public function store(MemoRequest $request, Memo $memo)
    {
        $memo->fill($request->all());
        $memo->user_id = Auth::id();
        $memo->save();

        $article = $request->article_id;

        return redirect()->route('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $memo = Memo::where('id', $id)->first();

        $article = Article::with(['user', 'likes', 'tags'])->where('id', $memo->article_id)->first();

        return view('memos.edit', compact('memo', 'article'));
    }

    public function update(MemoRequest $request, $id)
    {
        $memo = Memo::where('id', $id)->first();

        $memo->fill($request->all())->save();

        $article = $request->article_id;

        return redirect()->route('articles.show', compact('article'));
    }

    public function destroy(Memo $memo)
    {
        $memo->delete();
        return back();
    }
}
