<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required | max:25',
            'body' => 'required | max:255',
            // タグ名にはスペースと/を含ませないよう正規表現でバリデーション
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'news' => 'required | string | max:255',
            'url' => 'required | string | max:255',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'tags' => 'タグ',
            'news' => 'ニュース',
            'url' => 'ニュースURL',
        ];
    }

    /**
     * バリデーション後、下記メソッド内でjson形式の文字列を連想配列に変換
     * 連想配列をコレクションに変更後、コレクションメソッドでタグの個数制限と登録するタグをタグ名のみにする
     */
    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
