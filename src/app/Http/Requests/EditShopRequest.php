<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditShopRequest extends FormRequest
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
            'shop_name' => 'required',
            'detail' => 'required|max:120',
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '＊店舗名を入力してください。',
            'detail.required' => '＊紹介内容を入力してください。',
            'detail.max' => '＊紹介内容は120文字以下で入力してください。',
        ];
    }
}
