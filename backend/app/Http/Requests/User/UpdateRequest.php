<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * ゲストユーザーログイン時に、ユーザー名とメールアドレスを変更できないよう対策
     *
     * @return array
     */
    public function rules()
    {
        if (Auth::id() == config('user.guest_user_id')) {
            return [
                'introduction' => 'string | max:200 | nullable',
            ];
        } else {
            return [
                'name' => 'required | string | min:1 | max:25',
                'email' => 'required | string | email | max:255 |' . Rule::unique('users')->ignore(Auth::id()),
                'introduction' => 'string | max:255 | nullable',
                'image' => 'file | mimes:jpeg,png,jpg,bmb | max:2048 | nullable',
            ];
        }
    }
    /**
     * 更新対象となる画像を代入
     */
    public function getImage($request)
    {
        if (isset($request->image)) {
            $image = $request->image;
            return $image;
        }
    }
}
