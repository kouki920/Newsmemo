<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\Contact\ConfirmRequest;
use App\Http\Requests\Contact\SendRequest;
use Illuminate\Http\RedirectResponse;

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
     * 入力内容の修正時は値を保持したまま戻る(name="contact"のvalue値は必要ないのでexceptで除外する)
     *
     * @param  \App\Http\Requests\Contact\SendRequest $request
     * @param  \App\Models\Contact  $contact
     * @return Illuminate\Http\RedirectResponse
     */
    public function send(SendRequest $request, Contact $contact): RedirectResponse
    {
        // 確認画面でクリックしたボタン(name="contact")のvalue値を判断する
        $contactValue = $request->input('contact', 'back');

        if ($contactValue === 'submit') {
            $contact->user_id = $request->user()->id;
            $contact->fill($request->validated())->save();

            return redirect()->route('contacts.complete', ['id' => $request->user()->id]);
        } else {
            return redirect()->route('contacts.form', ['id' => $request->user()->id])->withInput($request->except('contact'));
        }
    }

    /**
     * 送信完了画面を表示
     *
     * @return Illuminate\View\View
     */
    public function complete()
    {
        return view('contacts.complete');
    }
}
