<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Category\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends AdminController
{

    /**
     * @var CategoryService
     */
    private $category;


    /**
     * CategoryController constructor.
     *
     * @param CategoryService $category
     */
    public function __construct(CategoryService $category)
    {
        $this->category = $category;
        parent::__construct();
    }

    public function manageCategory()
    {
        return view('admin.category.manageCategory');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->showLatestCategory();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->category->addCategory($request->all());
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->category->editCategory($request->except('_method','_token'), $id);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->deleteCategory($id);
        return response()->json(['done']);
    }
}
