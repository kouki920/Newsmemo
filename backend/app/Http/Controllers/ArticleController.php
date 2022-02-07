<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Article\ArticleServiceInterface;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Tag;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Services\Tag\TagServiceInterface;
use App\Models\NewsLink;
use App\Services\NewsLink\NewsLinkServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    private ArticleServiceInterface $articleService;
    private TagServiceInterface $tagService;
    private NewsLinkServiceInterface $newsLinkService;

    public function __construct(
        ArticleServiceInterface $articleService,
        TagServiceInterface $tagService,
        NewsLinkServiceInterface $newsLinkService
    ) {
        // ArticlePolicyの適用
        $this->authorizeResource(Article::class, 'article');

        $this->articleService = $articleService;
        $this->tagService = $tagService;
        $this->newsLinkService = $newsLinkService;
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
        $articles = $this->articleService->getArticleIndex($article, $request);

        // ランキングデータを取得
        $rankedArticles = $this->articleService->getArticleRanking($article);

        // ランキングデータを取得
        $rankedNews = $this->newsLinkService->getNewsRanking($newsLink);

        return view('articles.index', compact('articles', 'rankedArticles', 'rankedNews'));
    }

    /**
     * 新規投稿フォームの表示
     * 外部APIから取得したデータ(news,url)を渡す
     * タグデータの状態をVue Tags Input形式と同様にして予測変換を機能させる
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function create(Request $request, Tag $tag)
    {
        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $this->tagService->getAllTagNames();

        // 外部API(NEW API)で取得したデータを利用
        $news = $request->news;

        // 外部API(NEW API)で取得したデータを利用
        $url = $request->url;

        return view('articles.create', compact('allTagNames', 'news', 'url'));
    }

    /**
     * 投稿の登録
     * 外部API(NEW API)で取得したnewsへのリンク先とタイトルをnews_linksテーブルに保存
     * 投稿に関するタグの登録、投稿とタグの紐付けを実行
     *
     * @param \App\Http\Requests\Article\StoreRequest $request
     * @param \App\Models\Article $article
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $articleRecord = $request->validated();
        $tags = $request->tags;

        $this->articleService->store($articleRecord, $tags);

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
        // 投稿詳細画面でarticleデータに付属するマインドマップ(アウトプットデータ)を取得する
        $memos = $this->articleService->getMemoData($article);

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * 投稿編集フォームの表示
     * タグデータの状態をVue Tags Input形式と同様にして予測変換を機能させる
     *
     * @param \App\Models\Article $article
     * @param \App\Models\Tag $tag
     * @return Illuminate\View\View
     */
    public function edit(Article $article, Tag $tag)
    {
        // 編集対象となるタグデータの形式を変換する
        $tagNames = $this->tagService->getTagNamesOfArticle($article);

        // タグ入力欄でVue Tags Inputを利用して予測変換を表示させる
        $allTagNames = $this->tagService->getAllTagNames();

        return view('articles.edit', compact('article', 'tagNames', 'allTagNames'));
    }

    /**
     * 投稿の更新
     * タグの更新も対応
     *
     * @param  \Illuminate\Http\Requests\Article\UpdateRequest  $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Article $article): RedirectResponse
    {
        $articleRecord = $request->validated();
        $tags = $request->tags;

        $this->articleService->update($article, $articleRecord, $tags);

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
        $this->articleService->delete($article);

        return redirect()->route('articles.index')->with('msg_success', __('app.article_delete'));
    }
}
