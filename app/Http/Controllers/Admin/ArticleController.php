<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\EditArticleRequest;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\TagService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends AdminController
{

    /**
     * @var ArticleService
     */
    private $article;
    /**
     * @var CategoryService
     */
    private $category;
    /**
     * @var TagService
     */
    private $tag;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $article
     * @param CategoryService $category
     * @param TagService $tag
     */
    public function __construct(ArticleService $article, CategoryService $category, TagService $tag)
    {
        $this->article = $article;
        $this->category = $category;
        $this->tag = $tag;
        parent::__construct();
        $this->middleware('permission:系統管理|班級公告');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->article->showAllArticle();

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->showAllCategoryByArray();
        $tag_list = $this->tag->showAllTagByArray();

        return view('admin.article.create', compact('categories', 'tag_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $this->article->addArticle($request->all());

        return redirect()->route('backend.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $article =$this->article->showArticleById($id);

        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article =$this->article->showArticleById($id);
        $categories = $this->category->showAllCategoryByArray();
        $tag_list = $this->tag->showAllTagByArray();

        return view('admin.article.edit', compact('article', 'categories', 'tag_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditArticleRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditArticleRequest $request, $id)
    {
        $this->article->editArticle($request->except('_method','_token'), $id);

        return redirect()->route('backend.articles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->article->deleteArticle($id);
        return response()->json(['done']);
    }
}
