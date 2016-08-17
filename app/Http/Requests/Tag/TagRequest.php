<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\Request;

class TagRequest extends Request
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
            'name'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => '此欄位不能為空'
        ];
    }
}
