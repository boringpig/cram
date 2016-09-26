<?php

namespace App\Http\Controllers;

use App\Services\WorkService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WorkController extends Controller
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
	}

	/**
	 * AJAX顯示全部的工作
	 *
	 * @return mixed
	 */
	public function ajax_showAllWork()
	{
		$works = $this->work->showAllWork();

		return response()->json($works);
	}


	/**
	 * 打卡下班的工作
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function postUserWork(Request $request)
	{
		$this->work->addUserClockOutWork($request->all());

		return response()->json(['done']);
	}

}
