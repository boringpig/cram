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

	public function getRollCallIndex()
	{
		$lessons = $this->rollCall->showTodayAllRollCallLesson();

		return view('rollcall.index', compact('lessons'));
	}

	public function ajax_postSearchLesson(Request $request)
	{
		$rollCalls = $this->rollCall->showRollCallLesson($request->all());

		return response()->json($rollCalls);
	}

	public function ajax_postRollCallLesson(Request $request)
	{
		$rollCall = $this->rollCall->ajax_RollCallLesson($request->all());

		return response()->json($rollCall);
	}
}
