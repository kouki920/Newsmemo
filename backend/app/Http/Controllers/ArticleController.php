<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\NewsLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * 投稿一覧の表示
     * 検索機能実装
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article, NewsLink $newsLink)
    {
        $articles = Article::with(['user', 'likes', 'tags', 'newsLink'])
            ->orderBy('created_at', 'desc')
            ->search($request->input('search'))
            ->paginate(10);

        $ranked_articles = $article->articleRanking();
        $ranked_news = $newsLink->newsRanking();

        return view('articles.index', compact('articles', 'ranked_articles', 'ranked_news'));
    }

    /**
     * 新規投稿(メモ)フォームの表示
     * @param Request $request
     * @return \Illuminate\Http\Response
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
     *
     * @param \Illuminate\Http\Requests\Article\StoreRequest  $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();

        Article::find($article->id)->newsLink()->create($request->all());

        // タグの登録と投稿・タグの紐付けを行う
        $request->tagsRegister($article);

        return redirect()->route('articles.index')->with('msg_success', '投稿が完了しました');
    }

    /**
     * 投稿(メモ)詳細画面の表示
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $memos = $article->memos->where('article_id', $article->id)->sortBy('created_at');

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * 投稿(メモ)編集フォームの表示
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
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
     *
     * @param  \Illuminate\Http\Requests\Article\UpdateRequest  $request
     * @param  Article $article
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('msg_success', '投稿を削除しました');
    }
}
