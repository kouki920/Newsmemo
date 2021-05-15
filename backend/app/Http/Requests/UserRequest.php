<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        // ゲストユーザーログイン時に、ユーザー名とメールアドレスを変更できないよう対策
        if (Auth::user()->id == config('user.guest_user_id')) {
            return [
                'introduction' => 'string | max:200 | nullable',
            ];
        } else {
            return [
                'name' => 'required | string | min:1 | max:25',
                'email' => 'required | string | email | max:255 |' . Rule::unique('users')->ignore(Auth::id()),
                'introduction' => 'string | max:200 | nullable',
                'image' => 'file | mimes:jpeg,png,jpg,bmb | max:2048 | nullable',
            ];
        }
    }
}
