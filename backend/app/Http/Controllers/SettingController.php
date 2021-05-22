<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        session()->flash('msg_success', '設定を表示しました');
        return view('settings.index');
    }

    public function agreement()
    {
        session()->flash('msg_success', '利用規約を表示しました');
        return view('settings.agreement');
    }
}
