<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{

    /**
     * @var ArticleService
     */
    private $article;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $article
     */
    public function __construct(ArticleService $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->article->showAllArticle();

        return view('article.index', compact('articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->showArticleById($id);

        return view('article.show', compact('article'));
    }

}
