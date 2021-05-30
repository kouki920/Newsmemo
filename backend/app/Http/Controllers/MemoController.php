<?php

namespace App\Http\Controllers;

use App\Http\Requests\Memo\StoreRequest;
use App\Http\Requests\Memo\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class MemoController extends Controller
{

    public function store(StoreRequest $request, Memo $memo)
    {
        $memo->fill($request->all());
        $memo->user_id = Auth::id();
        $memo->save();

        $article = $request->articleId($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', '非公開メモを追加しました');
    }

    public function edit($id)
    {
        $memo = Memo::where('id', $id)->first();

        $article = Article::with(['user', 'likes', 'tags'])->where('id', $memo->article_id)->first();

        return view('memos.edit', compact('memo', 'article'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $memo = Memo::where('id', $id)->first();

        $memo->fill($request->all())->save();

        $article = $request->articleId($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', '非公開メモを更新しました');
    }

    public function destroy(Memo $memo)
    {
        $memo->delete();
        return back()->with('msg_success', '非公開メモを削除しました');
    }
}
