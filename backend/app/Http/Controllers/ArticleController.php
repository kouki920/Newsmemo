<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\NewsLink;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{

    public function __construct()
    {
        // ArticlePolicyの適用
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
        // Articleテーブルに関するデータを取得
        $articles = $article->getArticleIndex($request);

        // ランキングデータを取得
        $rankedArticles = $article->getArticleRanking();

        // ランキングデータを取得
        $rankedNews = $newsLink->getNewsRanking();

        return view('articles.index', compact('articles', 'rankedArticles', 'rankedNews'));
    }

    /**
     * 新規投稿フォームの表示
     * 外部APIから取得したデータ(news,url)を渡す
     * タグデータの状態をVue Tags Input形式と同様にして予測変換を機能させる
     * $tag->tag_predictive_conversionで\App\Models\Tagのアクセサ(getTagPredictiveConversionAttribute)を利用
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function create(Request $request, Tag $tag)
    {
        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $tag->tag_predictive_conversion;

        // 外部API(NEW API)で取得したデータを利用
        $news = $request->news;

        // 外部API(NEW API)で取得したデータを利用
        $url = $request->url;

        return view('articles.create', compact('allTagNames', 'news', 'url'));
    }

    /**
     * 投稿の登録
     * 外部API(NEW API)で取得したnewsへのリンク先とタイトルをnews_linksテーブルに保存
     * $article->newsLink()でリレーションのインスタンスが返るのでcreate()でデータを登録
     * 投稿に関するタグの登録、投稿とタグの紐付けを実行
     *
     * @param \App\Http\Requests\Article\StoreRequest $request
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Article $article): RedirectResponse
    {
        $article->user_id = $request->user()->id;
        $article->fill($request->validated())->save();

        // Articleモデルとリレーション関係であるNewsLinkモデル(news_linksテーブル)にデータ(article_id,news,url)を保存
        $article->newsLink()->create($request->validated());

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
        // 投稿詳細画面でarticleデータに付属するマインドマップ(アウトプット)を取得する
        $memos = $article->getArticleMemo();

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * 投稿編集フォームの表示
     * タグデータの状態をVue Tags Input形式と同様にして予測変換を機能させる
     * $tag->tag_predictive_conversionで\App\Models\Tagのアクセサ(getTagPredictiveConversionAttribute)を利用
     *
     * @param \App\Models\Article $article
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function edit(Article $article, Tag $tag)
    {
        // 編集対象となるタグデータの形式を変換するアクセサを利用
        $tagNames = $article->change_tag_format;

        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $tag->tag_predictive_conversion;

        return view('articles.edit', compact('article', 'tagNames', 'allTagNames'));
    }

    /**
     * 投稿の更新
     * タグの更新にも対応させる
     *
     * @param  \Illuminate\Http\Requests\Article\UpdateRequest  $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Article $article): RedirectResponse
    {
        $article->fill($request->validated())->save();

        // タグデータの更新
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', __('app.article_update'));
    }

    /**
     * 投稿の削除
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articles.index')->with('msg_success', __('app.article_delete'));
    }
}
