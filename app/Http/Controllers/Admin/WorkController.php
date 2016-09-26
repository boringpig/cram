<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Work\WorkRequest;
use App\Services\WorkService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WorkController extends AdminController
{

    /**
     * @var WorkService
     */
    private $work;

    /**
     * WorkController constructor.
     *
     * @param WorkService $work
     */
    public function __construct(WorkService $work)
    {
        $this->work = $work;
        parent::__construct();
        $this->middleware('permission:系統管理|人事管理');
    }

	/**
     * AJAX CRUD 工作
     *
     * @return mixed
     */
    public function manageWork()
    {
        return view('admin.work.manageWork');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = $this->work->showLatestWork();

        return response()->json($works);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param WorkRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        $work = $this->work->addWork($request->all());

        return response()->json($work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, $id)
    {
        $work = $this->work->updateWork($request->all(), $id);

        return response()->json($work);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->work->deleteWork($id);

        return response()->json(['done']);
    }
}
