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
    public function index(Request $request)
    {
        $collections = Collection::with('articles')->orderBy('created_at', 'desc')->get();

        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $allCollectionNames = Collection::all()->map(function ($collection) {
            return ['text' => $collection->name];
        });

        return view('articles.create', compact('allCollectionNames'));
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
            $collection = Collection::firstOrCreate(['name' => $collectionName]);
            $article->collections()->attach($collection);
        });
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $name)
    {
        $collection = Collection::where('name', $name)->first();

        $articles = $collection->articles->sortByDesc('created_at')->paginate(10);

        return view('collections.show', compact('collection', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection, Article $article)
    {
        // $collectionNames = $article->collections->map(function ($collection) {
        //     return ['text' => $collection->name];
        // });

        // $allCollectionNames = Collection::all()->map(function ($collection) {
        //     return ['text' => $collection->name];
        // });

        // return view('collections.collection', compact('collection', 'collectionNames', 'allCollectionNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // $article->collections()->detach();
        // $request->collections->each(function ($collectionName) use ($article) {
        //     $collection = Collection::firstOrCreate(['name' => $collectionName]);
        //     $article->collections()->attach($collection);
        // });

        // return redirect()->route('collections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('collections.index');
    }
}
