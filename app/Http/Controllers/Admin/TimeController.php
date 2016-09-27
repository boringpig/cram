<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Services\TimeService;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimeController extends AdminController
{

    /**
     * @var TimeService
     */
    private $time;

    /**
     * TimeController constructor.
     *
     * @param TimeService $time
     */
    public function __construct(TimeService $time)
    {
        $this->time = $time;
        parent::__construct();
        $this->middleware('permission:系統管理|班級事務');
    }

	/**
     * 處理AJAX的時間頁面
     *
     * @return mixed
     */
    public function manageTime()
    {
        return view('admin.lesson.time.manageTime');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = $this->time->showLatestAllTime();

        return response()->json($times);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = $this->time->addTime($request->all());

        return response()->json($time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $time = $this->time->editTime($request->except('_method', '_token'), $id);

        return response()->json($time);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->time->deleteTime($id);

        return response()->json(['done']);
    }
}
