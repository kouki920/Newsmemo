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

    /**
     * 非公開メモの登録
     *
     * @param \App\Http\Requests\Memo\StoreRequest $request
     * @param \App\Models\Memo $memo
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Memo $memo)
    {
        $memo->user_id = Auth::id();
        $memo->article_id = $request->article_id;
        $memo->fill($request->validated())->save();

        $article = $request->getArticleData($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', '非公開メモを追加しました');
    }

    /**
     * 非公開メモの編集
     *
     * @param int $id
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $memo = Memo::where('id', $id)->first();

        $article = Article::with(['user', 'likes', 'tags'])->where('id', $memo->article_id)->first();

        return view('memos.edit', compact('memo', 'article'));
    }

    /**
     * 非公開メモの更新
     *
     * @param \App\Http\Requests\Memo\UpdateRequest $request
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $memo = Memo::where('id', $id)->first();

        $memo->fill($request->validated())->save();

        $article = $request->getArticleData($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', '非公開メモを更新しました');
    }

    /**
     * 非公開メモの削除
     *
     * @param \App\Models\Memo $memo
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();
        return back()->with('msg_success', '非公開メモを削除しました');
    }
}
