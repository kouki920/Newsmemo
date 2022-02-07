<?php

namespace App\Http\Controllers;

use App\Http\Requests\Memo\StoreRequest;
use App\Http\Requests\Memo\UpdateRequest;
use App\Models\Article;
use App\Models\Memo;
use App\Services\Memo\MemoServiceInterface;
use Illuminate\Http\RedirectResponse;

class MemoController extends Controller
{
    private MemoServiceInterface $memoService;

    public function __construct(
        MemoServiceInterface $memoService
    ) {
        $this->memoService = $memoService;
    }

    /**
     * マインドマップの登録
     *
     * @param \App\Http\Requests\Memo\StoreRequest $request
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Article $article): RedirectResponse
    {
        $articleId = $request->article_id;
        $memoRecord = $request->validated();

        $this->memoService->store($memoRecord, $articleId);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', __('app.memo_store'));
    }

    /**
     * マインドマップの編集
     * 編集ボタンクリックで編集画面に遷移
     *
     * @param \App\Models\Memo $memo
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function edit(Memo $memo, Article $article)
    {
        return view('memos.edit', compact('memo', 'article'));
    }

    /**
     * マインドマップの更新
     *
     * @param \App\Http\Requests\Memo\UpdateRequest $request
     * @param \App\Models\Memo $memo
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Memo $memo, Article $article): RedirectResponse
    {
        $memoRecord = $request->validated();

        $this->memoService->update($memo, $memoRecord);

        return redirect()->route('articles.show', compact('article'))->with('msg_success', __('app.memo_update'));
    }

    /**
     * マインドマップの削除
     *
     * @param \App\Models\Memo $memo
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Memo $memo): RedirectResponse
    {
        $this->memoService->delete($memo);

        return back()->with('msg_success', __('app.memo_delete'));
    }
}
