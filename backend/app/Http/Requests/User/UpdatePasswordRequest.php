<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
     * ゲストユーザーログイン時に、パスワードを変更できないよう対策
     *
     * @return array
     */
    public function rules()
    {
        if (Auth::id() != config('user.guest_user_id')) {
            return [
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!(Hash::check($value, Auth::user()->password))) {
                            return $fail('現在のパスワードを正しく入力してください');
                        }
                    },
                ],
                'new_password' => 'required|string|min:8|max:16|confirmed|different:current_password',
            ];
        }
    }
}
