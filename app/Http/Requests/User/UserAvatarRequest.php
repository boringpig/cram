<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserAvatarRequest extends Request
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
            'avatar' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => '必須選擇一張圖片',
            'avatar.image' => '上傳的檔案不符合圖片格式'
        ];
    }
}
