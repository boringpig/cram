<?php

namespace App\Http\Controllers\Admin;

use App\Services\RollCallService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RollCallController extends Controller
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
	}

	public function getRollCallViewDate()
	{
		return view('admin.lesson.rollcall.view-date');
	}

	public function ajax_searchRollCallDate(Request $request)
	{
		$rollCall = $this->rollCall->showRollCallByDate($request->all());

		return response()->json($rollCall);
	}

	public function getRollCallViewLesson()
	{
		$lesson_list = $this->rollCall->showRollCallLessonByArray();

		return view('admin.lesson.rollcall.view-lesson', compact('lesson_list'));
	}

	public function ajax_searchRollCallLesson(Request $request)
	{
		$rollCall = $this->rollCall->showRollCallByLesson($request->all());

		return response()->json($rollCall);
	}

	public function showRollCall($id)
	{
		$rollCall = $this->rollCall->showRollCallById($id);
		$students = $rollCall->students()->get();

		return view('admin.lesson.rollcall.show', compact('rollCall', 'students'));
	}

	public function postUpdateRollCall(Request $request, int $id)
	{
		$rollCall = $this->rollCall->editRollCallById($request->except('_method', '_token'), $id);

		return redirect()->route('rollCall.show', $rollCall->id);
	}

}
