<?php

namespace App\Http\Controllers;

use App\Services\CalendarEventService;
use Illuminate\Http\Request;

use App\Http\Requests;

class CalendarEventController extends Controller
{

	/**
	 * @var CalendarEventService
	 */
	private $calendarEvent;


	/**
	 * CalendarEventController constructor.
	 *
	 * @param CalendarEventService $calendarEvent
	 */
	public function __construct(CalendarEventService $calendarEvent)
	{
		$this->calendarEvent = $calendarEvent;
	}

	public function ajax_showAllEvent()
	{
		$events = $this->calendarEvent->showAllEvent();

		return response()->json($events);
	}
}
