<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\Request;

class MessageRequest extends Request
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
            'email' => 'required|email',
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => '請輸入正確的email格式',
            'email.required' => '信箱欄位不能為空',
            'title.required' => '主旨欄位不能為空',
            'content.required' => '訊息欄位不能為空'
        ];
    }
}
