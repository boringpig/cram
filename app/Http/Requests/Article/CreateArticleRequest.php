<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\Request;

class CreateArticleRequest extends Request
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
            'title' => 'required|min:3|max:255',
            'slug'  => 'required|min:6|max:255|unique:articles',
            'body'  => 'required',
            'article_image' => 'image'
        ];
    }
}
