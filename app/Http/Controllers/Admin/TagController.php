<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Tag\TagRequest;
use App\Services\TagService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends AdminController
{

    /**
     * @var TagService
     */
    private $tag;


    /**
     * TagController constructor.
     *
     * @param TagService $tag
     */
    public function __construct(TagService $tag)
    {
        $this->tag = $tag;
        parent::__construct();
        $this->middleware('permission:系統管理|班級公告');
    }

	/**
     * AJAX CRUD 文章標籤
     *
     * @return mixed
     */
    public function manageTag()
    {
        return view('admin.tag.manageTag');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->showLatestTag();
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $category = $this->tag->addTag($request->all());
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $tag = $this->tag->editTag($request->except('_method','_token'), $id);
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tag->deleteTag($id);
        return response()->json(['done']);
    }
}
