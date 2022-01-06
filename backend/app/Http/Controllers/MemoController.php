<?php

namespace App\Http\Controllers;

use App\Http\Requests\Memo\StoreRequest;
use App\Http\Requests\Memo\UpdateRequest;
use App\Models\Article;
use App\Models\Memo;
use Illuminate\Http\RedirectResponse;

class MemoController extends Controller
{

    /**
     * マインドマップの登録
     *
     * @param \App\Http\Requests\Memo\StoreRequest $request
     * @param \App\Models\Memo $memo
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Memo $memo): RedirectResponse
    {
        $memo->user_id = $request->user()->id;
        $memo->article_id = $request->article_id;
        $memo->fill($request->validated())->save();

        // マインドマップ登録対象となるarticleデータのidを$requestから取得する
        $article = $request->getArticleId($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', __('app.memo_store'));
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
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $memo = Memo::where('id', $id)->first();

        $memo->fill($request->validated())->save();

        $article = $request->getArticleData($request);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', __('app.memo_update'));
    }

    /**
     * 非公開メモの削除
     *
     * @param \App\Models\Memo $memo
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Memo $memo): RedirectResponse
    {
        $memo->delete();
        return back()->with('msg_success', __('app.memo_delete'));
    }
}
