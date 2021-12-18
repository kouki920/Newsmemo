<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\NewsLink;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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

        // ランキングデータを取得
        $rankedArticles = $article->getArticleRanking();

        // ランキングデータを取得
        $rankedNews = $newsLink->getNewsRanking();

        return view('articles.index', compact('articles', 'rankedArticles', 'rankedNews'));
    }

    /**
     * 新規投稿(メモ)フォームの表示
     * APIで取得したデータ(news,url)を渡し、タグ登録時の状態をVue Tags Inputと同様にする
     * $tag->tag_associative_arrayで\App\Models\Tagのアクセサを利用
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function create(Request $request, Tag $tag)
    {
        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $tag->tag_associative_array;

        // 外部API(NEW API)で取得したデータを利用
        $news = $request->news;

        // 外部API(NEW API)で取得したデータを利用
        $url = $request->url;

        return view('articles.create', compact('allTagNames', 'news', 'url'));
    }

    /**
     * 投稿(メモ)の登録
     * 外部API(NEW API)で取得したnewsへのリンク先とタイトルをnews_linksテーブルに保存
     * タグの登録と投稿とタグの紐付けを実行
     *
     * @param \App\Http\Requests\Article\StoreRequest  $request
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Article $article): RedirectResponse
    {
        $article->user_id = Auth::id();
        $article->fill($request->validated())->save();

        // Articleモデルとリレーション関係であるNewsLinkモデル(news_linksテーブル)にデータ(news,url)を保存
        Article::find($article->id)->newsLink()->create($request->validated());

        // タグの登録、投稿とタグの紐付けを実行
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', __('app.article_store'));
    }

    /**
     * 投稿詳細画面の表示
     *
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function show(Article $article)
    {
        // 投稿詳細画面でarticleデータに付属する非公開メモ(アウトプット)を取得する
        $memos = $article->getArticleMemo();

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * 投稿(メモ)編集フォームの表示
     *
     * @param \App\Models\Article $article
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function edit(Article $article, Tag $tag)
    {
        // Vue Tags Inputでは、タグ名に対しtextというキーが付いている必要があるのでmapメソッドを使用して同様の連想配列を作成
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => optional($tag)->name];
        });

        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $tag->tag_associative_array;

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
    public function update(UpdateRequest $request, Article $article): RedirectResponse
    {
        // ArticlePolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $article);

        $article->fill($request->validated())->save();
        // タグの更新
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', __('app.article_update'));
    }

    /**
     * 投稿(メモ)の削除
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        // ArticlePolicyのdeleteメソッドでアクセス制限
        $this->authorize('delete', $article);

        $article->delete();
        return redirect()->route('articles.index')->with('msg_success', __('app.article_delete'));
    }
}
