<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\Article;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ユーザー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at')->paginate(10);

        $articles_count = $user->countArticle();

        $days_posted = $articles->groupBy('created_date')->count();

        $total_category = $article->totalCategory($user->id);

        session()->flash('msg_success', 'プロフィールを表示しました');
        return view('users.show', compact('user', 'articles', 'total_category', 'articles_count', 'days_posted'));
    }

    /**
     * ユーザデータの編集
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        // $this->authorize('update', $user);

        session()->flash('msg_success', '登録情報を編集してください');
        return view('users.edit', compact('user'));
    }

    /**
     * ユーザデータの更新
     * @param UserRequest $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        // $this->authorize('update', $user);

        $user->fill($request->all())->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'プロフィールを編集しました');
    }

    /**
     * プロフィールアイコンの編集画面を表示
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function imageEdit(string $name)
    {
        $user = User::where('name', $name)->first();

        session()->flash('msg_success', 'プロフィールアイコンを選んでください');
        return view('users.image_edit', compact('user'));
    }

    /**
     * プロフィールアイコンの更新
     * @param UserRequest $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function imageUpdate(UpdateRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $image = $request->getImage($request);

        if ($image->isValid()) {
            $filePath = $image->store('public');
            $user->image = str_replace('public/', '', $filePath);
            $user->save();
        }

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'プロフィールアイコンを変更しました');
    }

    /**
     * フォロワー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function follower(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        $total_category = $article->totalCategory($user->id);

        session()->flash('msg_success', 'フォロワーリストを表示しました');
        return view('users.follower', compact('user', 'followers', 'total_category'));
    }

    /**
     * フォロー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function following(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        $total_category = $article->totalCategory($user->id);

        session()->flash('msg_success', 'フォローリストを表示しました');
        return view('users.following', compact('user', 'followings', 'total_category'));
    }

    /**
     * いいねした投稿を一覧表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function likes(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at')->paginate(10);

        $articles_count = $user->countArticle();

        $total_category = $article->totalCategory($user->id);

        session()->flash('msg_success', '後で読むリストを表示しました');
        return view('users.likes', compact('user', 'articles', 'total_category', 'articles_count'));
    }

    /**
     * ユーザーデータを表示
     */
    public function userData(Article $article, Login $login, string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->articles;
        $logins = $user->logins;

        $articles_count = $user->countArticle();

        $total_category = $article->totalCategory($user->id);

        $days_posted = $articles->groupBy('created_date')->count();

        $total_login = $logins->groupBy('login_date')->count();
        dd($total_login);

        session()->flash('msg_success', 'ユーザーデータを表示しました');
        return view('users.data', compact('user', 'articles_count', 'total_category', 'days_posted'));
    }

    /**
     * パスワード変更
     */
    public function editPassword(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        session()->flash('msg_success', 'パスワードを変更してください');

        return view('users.password_edit', compact('user'));
    }

    /**
     * パスワードの更新
     */
    public function updatePassword(UpdatePasswordRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'パスワードを変更しました');
    }


    /**
     * ユーザーデータの削除(退会)
     * @param string $name
     */
    public function destroy(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        if ($user->id != config('user.guest_user_id')) {
            $user->delete();
        }

        return redirect('register')->with('msg_success', 'ユーザー登録をしてください');
    }
}
