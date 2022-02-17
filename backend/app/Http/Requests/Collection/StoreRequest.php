<?php

namespace App\Http\Requests\Collection;

use App\Models\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'collections' => 'json|regex:/^(?!.*\/).*$/u | max:255',
        ];
    }

    /**
     * JSON形式の文字列のままだとPHPで取り扱うことはできないので、json_decode関数で連想配列に変換
     * 連想配列をcollect関数でコレクションに変換後、コレクションメソッドでデータを加工する
     * sliceメソッドでタグの個数制限と、mapメソッドの繰り返し処理で登録するタグデータをタグ名('Example')のみの新しいコレクションとして作成する
     * mapメソッドのクロージャの引数($requestTag)にはmapメソッドで利用するコレクションの要素が入る(フォームで入力したtagデータのコレクション形式)
     * 結果的にmapメソッドの戻り値は、return $requestTag->textで['text' => 'Example',]に該当する['Example',]といったコレクションになる
     */
    public function passedValidation()
    {
        $this->collections = collect(json_decode($this->collections))
            ->slice(0, 1)
            ->map(function ($requestCollection) {
                return $requestCollection->text;
            });
    }
}
