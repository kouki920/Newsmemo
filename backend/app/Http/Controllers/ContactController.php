<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\ConfirmRequest;

class ContactController extends Controller
{
    public function form()
    {
        return view('contacts.form');
    }

    public function confirm(ConfirmRequest $request)
    {
        $inputs = $request->all();
        // $inputs = $request->session()->get("form_input");

        return view('contacts.confirm', compact('inputs'));
    }

    public function send(Request $request, Contact $contact)
    {
        $action = $request->get('action', 'back');
        $input = $request->except('action');

        if ($action === 'submit') {
            $contact->fill($input);
            $contact->save();

            return redirect()->route('contacts.complete')->with('msg_success', 'お問い合わせありがとうございました');
        } else {
            return redirect()->route('contacts.form')->withInput($input);
        }
    }

    public function complete(Request $request)
    {
        return view('contacts.complete');
    }
}
