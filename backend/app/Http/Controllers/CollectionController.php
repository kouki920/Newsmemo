<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collection;
use App\Http\Requests\Collection\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $collections = Collection::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('collections.index', compact('collections'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Article $article)
    {
        $request->collections->each(function ($collectionName) use ($article) {
            $collection = Collection::firstOrCreate(['name' => $collectionName, 'user_id' => Auth::id()]);
            $article->collections()->syncWithoutDetaching($collection);
        });
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $name, $id)
    {
        $collection = Collection::where('name', $name)->where('user_id', $id)->first()->load(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink']);

        $articles = $collection->articles->sortByDesc('created_at')->paginate(10);

        return view('collections.show', compact('collection', 'articles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection, $id)
    {
        $collection->fill($request->all())->save();

        $collections = Collection::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('collections.index', compact('collections'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection, $id)
    {
        $collection->delete();

        $collections = Collection::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('collections.index', compact('collections'));
    }

    /**
     * コレクションに登録されたメモを削除する(メモ自体は削除されない)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Collection $collection
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function articleCollectionDestroy(Request $request, Collection $collection, Article $article)
    {
        $article->collections()->detach(['article_id' => $article->id, 'collection_id' => $collection->id]);
        $collections = Collection::with('articles')->orderBy('created_at', 'desc')->get();
        return view('collections.index', compact('collections'));
    }
}
