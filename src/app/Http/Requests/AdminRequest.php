<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '＊名前を入力してください。',
            'email.required' => '＊メールアドレスを入力してください。',
            'emial.email' => '＊有効なメールアドレスを入力してください。',
            'email.unique' => '＊このメールアドレスは既に登録されています。',
            'password.required' => '＊パスワードを入力してください。',
            'password.confirmed' => '＊確認用パスワードと一致しません。',
            'password_confirmation.required' => '＊確認用パスワードを入力してください。',

        ];
    }
}
