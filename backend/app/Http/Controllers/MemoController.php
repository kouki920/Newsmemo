<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemoRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{

    public function store(MemoRequest $request, Memo $memo, Article $article)
    {
        $memo->fill($request->all());
        $memo->user_id = Auth::id();
        $memo->save();

        return redirect()->route('articles.show');
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
