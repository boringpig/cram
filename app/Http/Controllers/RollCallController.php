<?php

namespace App\Http\Controllers;

use App\Services\RollCallService;
use Illuminate\Http\Request;

use App\Http\Requests;

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

	/**
	 * 顯示班級點名
	 *
	 * @return mixed
	 */
	public function getRollCallIndex()
	{
		$lessons = $this->rollCall->showTodayAllRollCallLesson();

		return view('rollcall.index', compact('lessons'));
	}

	/**
	 * AJAX選擇點名的班級
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function ajax_postSearchLesson(Request $request)
	{
		$rollCalls = $this->rollCall->showRollCallLesson($request->all());

		return response()->json($rollCalls);
	}

	/**
	 * AJAX點名班級的學生
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function ajax_postRollCallLesson(Request $request)
	{
		$rollCall = $this->rollCall->ajax_RollCallLesson($request->all());

		return response()->json($rollCall);
	}
}
