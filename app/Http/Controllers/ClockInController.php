<?php

namespace App\Http\Controllers;

use App\Services\ClockInService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ClockInController extends Controller
{

	/**
	 * @var ClockInService
	 */
	private $clockIn;


	/**
	 * ClockInController constructor.
	 *
	 * @param ClockInService $clockIn
	 */
	public function __construct(ClockInService $clockIn)
	{
		$this->clockIn = $clockIn;
	}

	public function index()
	{
		return view('clockin.index');
    }


}
