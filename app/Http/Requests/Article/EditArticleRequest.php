<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\Request;
use App\Models\Article;

class EditArticleRequest extends Request
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
        $rules = [
            'title' => 'required|min:3|max:255',
            'slug'  => 'required|min:6|max:255|unique:articles',
            'body'  => 'required'
        ];

        $article = Article::find($_REQUEST['id']);

        if ($_REQUEST['slug'] === $article->slug){
            $rules['title'] = 'required|min:3|max:255';
            $rules['slug'] = 'required|min:6|max:255';
            $rules['body'] = 'required';
        }

        return $rules;
    }
}
