<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collection;
use App\Http\Requests\Collection\StoreRequest;
use App\Http\Requests\Collection\UpdateRequest;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * ログインユーザーが保持するコレクションデータを一覧で取得
     *
     * @param \App\Models\Collection $collection
     * @param int $id
     * @return Illuminate\View\View
     */
    public function index(Collection $collection, $id)
    {
        $collections = $collection->getCollectionIndex($id);

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
    public function store(StoreRequest $request, Article $article)
    {
        $request->collectionRegister($article);
    }


    /**
     * コレクション名を選択することでそのコレクションに属する投稿を一覧で取得
     *
     * @param \App\Models\Collection $collection
     * @param  int  $id
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(Collection $collection, string $name, $id)
    {
        $collection = $collection->getCollectionShow($name, $id);

        $articles = $collection->getCollectionArticleData();

        return view('collections.show', compact('collection', 'articles'));
    }


    /**
     * コレクション名を更新
     *
     * @param  \App\Http\Requests\Collection\UpdateRequest  $request
     * @param \App\Models\Collection $collection
     * @param  int  $id
     * @return Illuminate\View\View
     */
    public function update(UpdateRequest $request, Collection $collection, $id)
    {
        $collection->fill($request->validated())->save();

        $collections = $collection->getCollectionIndex($id);

        return view('collections.index', compact('collections'));
    }

    /**
     * コレクションを削除
     *
     * @param  \App\Models\Collection  $collection
     * @param  int  $id
     * @return Illuminate\View\View
     */
    public function destroy(Collection $collection, $id)
    {
        $collection->delete();

        $collections = $collection->getCollectionIndex($id);
        return view('collections.index', compact('collections'));
    }

    /**
     * コレクションに登録されたメモをコレクション内から削除する
     * メモ自体はテーブルから削除されない
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Collection $collection
     * @param Article $article
     * @param  int  $id
     * @return Illuminate\View\View
     */
    public function articleCollectionDestroy(Request $request, Collection $collection, Article $article, $id)
    {
        $article->collections()->detach(['article_id' => $article->id, 'collection_id' => $collection->id]);

        $collections = $collection->getCollectionIndex($id)->load('articles');

        return view('collections.index', compact('collections'));
    }
}
