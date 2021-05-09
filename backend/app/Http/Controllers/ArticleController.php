<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Memo;
use Illuminate\Http\Request;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Requests\Article\IndexRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     * 検索機能実装
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article)
    {
        $query = Article::with(['user', 'likes', 'tags'])->orderBy('created_at', 'desc');

        $search = $request->input('search');

        if ($search !== null) {

            $search_splits = preg_split('/[\p{Z}\p{Cc}]++/u', $search, -1, PREG_SPLIT_NO_EMPTY);
            //半角全角スペース，改行，タブ，ノーブレークスペースなどの空白系の制御文字を対象とする

            foreach ($search_splits as $value) {

                $query->where('title', 'like', '%' . $value . '%')
                    ->orWhere('body', 'like', '%' . $value . '%')
                    ->orWhere('news', 'like', '%' . $value . '%');
            }
        }
        $articles = $query->paginate(10);
        // $articles = $request->filters();

        $ranked_articles = $article->articleRanking();
        $ranked_news = $article->newsRanking();

        return view('articles.index', compact('articles', 'ranked_articles', 'ranked_news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $news = $request->news;
        $url = $request->url;

        return view('articles.create', compact('allTagNames', 'news', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();

        //タグの登録と投稿・タグの紐付けを行う
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index')->with('msg_success', '投稿が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $memos = $article->memos->where('article_id', $article->id)->sortBy('created_at');

        return view('articles.show', compact('article', 'memos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $news = $request->news;
        $url = $request->url;

        return view('articles.edit', compact('article', 'tagNames', 'allTagNames', 'news', 'url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Article $article)
    {
        $article->fill($request->all())->save();

        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index')->with('msg_success', '投稿を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('msg_success', '投稿を削除しました');
    }

    /**
     * いいね機能のアクションメソッド
     * detachで複数回いいねの対策
     */
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
