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
     * 顯示文章首頁
     *
     * @return mixed
     */
    public function getArticlePage()
    {
        $articles = $this->article->showAllArticle();

        return view('article.index', compact('articles'));
    }

	/**
     * 顯示特定的文章
     *
     * @param string $slug
     * @return mixed
     */
    public function getArticleBySlug(string $slug)
    {
        $article = $this->article->showArticleBySlug($slug);

        return view('article.show', compact('article'));
    }


}
