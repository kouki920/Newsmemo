<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\NewsLink;
use Illuminate\Http\Request;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * 投稿の一覧を表示
     * 検索機能、ランキング機能を実装
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @param \App\Models\NewsLink $newsLink
     * @return Illuminate\View\View
     */
    public function index(Request $request, Article $article, NewsLink $newsLink)
    {
        $articles = $article->getArticleIndex($request);

        $ranked_articles = $article->getArticleRanking();
        $ranked_news = $newsLink->getNewsRanking();

        return view('articles.index', compact('articles', 'ranked_articles', 'ranked_news'));
    }

    /**
     * 新規投稿(メモ)フォームの表示
     * APIで取得したデータを渡し、タグ登録時の状態をVue Tags Inputと同様にする
     *
     * @param \Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Vue Tags Inputでは、タグ名に対しtextというキーが付いている必要があるのでmapメソッドを使用して同様の連想配列を作成
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $news = $request->news;
        $url = $request->url;

        session()->flash('msg_success', '投稿してください');
        return view('articles.create', compact('allTagNames', 'news', 'url'));
    }

    /**
     * 投稿(メモ)の登録
     * APIで取得したnewsへのリンク先とタイトルをnews_linksテーブルに保存、タグの登録と投稿とタグの紐付けも実行
     *
     * @param \App\Http\Requests\Article\StoreRequest  $request
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Article $article)
    {
        $article->user_id = Auth::id();
        $article->fill($request->validated())->save();

        Article::find($article->id)->newsLink()->create($request->validated());

        // タグの登録、投稿とタグの紐付けも行う
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', '投稿が完了しました');
    }

    /**
     * 投稿(メモ)詳細画面の表示
     *
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function show(Article $article)
    {
        $memos = $article->getArticleMemo();

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * 投稿(メモ)編集フォームの表示
     *
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function edit(Article $article)
    {
        // Vue Tags Inputでは、タグ名に対しtextというキーが付いている必要があるのでmapメソッドを使用して同様の連想配列を作成
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => optional($tag)->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => optional($tag)->name];
        });

        session()->flash('msg_success', '投稿を編集してください');
        return view('articles.edit', compact('article', 'tagNames', 'allTagNames'));
    }

    /**
     * 投稿(メモ)の更新
     * タグの更新にも対応させる
     *
     * @param  \Illuminate\Http\Requests\Article\UpdateRequest  $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Article $article)
    {
        $article->fill($request->validated())->save();
        // タグの更新
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', '投稿を編集しました');
    }

    /**
     * 投稿(メモ)の削除
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('msg_success', '投稿を削除しました');
    }
}
