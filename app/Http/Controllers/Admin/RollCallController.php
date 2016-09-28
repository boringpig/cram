<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Services\RollCallService;
use Illuminate\Http\Request;

use App\Http\Requests;

class RollCallController extends AdminController
{

	/**
	 * @var RollCallService
	 */
	private $rollCall;


	/**
	 * RollCallController constructor.
	 *
	 * @param RollCallService $rollCall
	 */
	public function __construct(RollCallService $rollCall)
	{
		$this->rollCall = $rollCall;
		parent::__construct();
		$this->middleware('permission:系統管理|班級事務');
	}

	/**
	 * 顯示查詢年/月的頁面
	 *
	 * @return mixed
	 */
	public function getRollCallViewDate()
	{
		return view('admin.lesson.rollcall.view-date');
	}

	/**
	 * AJAX搜尋年/月
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function ajax_searchRollCallDate(Request $request)
	{
		$rollCall = $this->rollCall->showRollCallByDate($request->all());

		return response()->json($rollCall);
	}

	/**
	 * 顯示查詢班級的頁面
	 *
	 * @return mixed
	 */
	public function getRollCallViewLesson()
	{
		$lesson_list = $this->rollCall->showRollCallLessonByArray();

		return view('admin.lesson.rollcall.view-lesson', compact('lesson_list'));
	}

	/**
	 * AJAX搜尋班級
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function ajax_searchRollCallLesson(Request $request)
	{
		$rollCall = $this->rollCall->showRollCallByLesson($request->all());

		return response()->json($rollCall);
	}

	/**
	 * 顯示特定點名單
	 *
	 * @param $id
	 * @return mixed
	 */
	public function showRollCall($id)
	{
		$rollCall = $this->rollCall->showRollCallById($id);
		$students = $rollCall->students()->get();

		return view('admin.lesson.rollcall.show', compact('rollCall', 'students'));
	}

	/**
	 * 更新點名單學生出缺席
	 *
	 * @param Request $request
	 * @param int $id
	 * @return mixed
	 */
	public function postUpdateRollCall(Request $request, int $id)
	{
		$rollCall = $this->rollCall->editRollCallById($request->except('_method', '_token'), $id);
		alert()->success('點名單修改成功')->persistent('關閉');

		return redirect()->route('rollCall.show', $rollCall->id);
	}

}
