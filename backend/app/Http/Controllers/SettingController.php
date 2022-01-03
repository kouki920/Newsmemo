<?php

namespace App\Http\Controllers;


class SettingController extends Controller
{
    /**
     * 設定項目一覧ページを表示
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * 利用規約ページの表示
     *
     * @return Illuminate\View\View
     */
    public function agreement()
    {
        return view('settings.agreement');
    }
}
