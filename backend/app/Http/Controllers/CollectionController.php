<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collection;
use App\Http\Requests\Collection\StoreRequest;
use App\Http\Requests\Collection\UpdateRequest;
use App\Services\Collection\CollectionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CollectionController extends Controller
{
    private CollectionServiceInterface $collectionService;

    public function __construct(
        CollectionServiceInterface $collectionService
    ) {
        $this->collectionService = $collectionService;
    }

    /**
     * ログインユーザーが保持するコレクションデータを一覧で取得
     *
     * @param \App\Models\Collection $collection
     * @param int $id
     * @return Illuminate\View\View
     */
    public function index(Collection $collection, $id)
    {
        $collections = $this->collectionService->getCollectionIndex($collection, $id);

        return view('collections.index', compact('collections'));
    }


    /**
     * 新規コレクションや既存コレクションに投稿を保存
     * vue.jsを利用して非同期処理で保存を実行する
     * collectionRegister()でコレクションを保存
     *
     * @param  \App\Http\Requests\Collection\StoreRequest  $request
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function store(StoreRequest $request, Article $article): void
    {
        $collections = $request->collections;

        $this->collectionService->registerCollection($article, $collections);
    }


    /**
     * コレクション名を選択することでそのコレクションに属する投稿を一覧で取得
     * $collection->articlesの戻り値がコレクションオブジェクト(Illuminate\...\Collection)なので
     * foreach処理できるようcompact('collections')で値を渡す
     *
     * @param \App\Models\Collection $collection
     * @param string $name
     * @param  int  $id
     * @return Illuminate\View\View
     */
    public function show(Collection $collection, string $name, $id)
    {
        // リクエストフォームで送られてきた$nameと$idに一致するcollectionデータを取得
        $collections = $this->collectionService->getCollectionData($collection, $name, $id);

        // $nameと$idに一致するコレクションデータに属するarticlesデータを取得
        $articles = $this->collectionService->getCollectionArticleData($collections);

        return view('collections.show', compact('collections', 'articles'));
    }


    /**
     * コレクション名を更新
     *
     * @param  \App\Http\Requests\Collection\UpdateRequest  $request
     * @param \App\Models\Collection $collection
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Collection $collection, $id): RedirectResponse
    {
        $collectionRecord = $request->validated();

        $this->collectionService->update($collection, $collectionRecord);

        return redirect()->route('collections.index', compact('id'))->with('msg_success', __('app.collection_update'));
    }

    /**
     * コレクションを削除
     *
     * @param  \App\Models\Collection  $collection
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Collection $collection, $id): RedirectResponse
    {
        $this->collectionService->destroy($collection);

        return redirect()->route('collections.index', compact('id'))->with('msg_success', __('app.collection_delete'));
    }

    /**
     * コレクションに登録された投稿をコレクション内から削除する
     * 投稿自体はarticlesテーブルから削除されない
     *
     * @param \App\Models\Collection $collection
     * @param \App\Models\Article $article
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyArticleInCollection(Collection $collection, Article $article, $id): RedirectResponse
    {
        $this->collectionService->destroyArticleInCollection($collection, $article);

        return redirect()->route('collections.index', compact('id'))->with('msg_success', __('app.collection_article'));
    }
}
