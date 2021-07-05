<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\ConfirmRequest;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームを表示
     *
     * @return Illuminate\View\View
     */
    public function form()
    {
        return view('contacts.form');
    }

    /**
     * 入力内容の確認画面を表示
     *
     * @param  \App\Http\Requests\Contact\ConfirmRequest  $request
     * @return Illuminate\View\View
     */
    public function confirm(ConfirmRequest $request)
    {
        $inputs = $request->validated();

        return view('contacts.confirm', compact('inputs'));
    }

    /**
     * お問い合わせ内容を送信
     * 入力内容の修正時は値を保持したまま戻る
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Contact  $contact
     * @return Illuminate\Http\RedirectResponse
     */
    public function send(Request $request, Contact $contact)
    {
        $action = $request->get('action', 'back');
        $input = $request->except('action');

        if ($action === 'submit') {
            $contact->fill($input)->save();

            return redirect()->route('contacts.complete');
        } else {
            return redirect()->route('contacts.complete')->withInput($input);
        }
    }

    /**
     * 送信完了画面を表示
     *
     * @param \Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function complete(Request $request)
    {
        return view('contacts.complete');
    }
}
