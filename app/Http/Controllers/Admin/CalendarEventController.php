<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\CalendarEvent;
use App\Services\CalendarEventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;

class CalendarEventController extends AdminController
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
        parent::__construct();
        $this->middleware('permission:系統管理|班級公告');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->calendarEvent->showAllEvent();

        return view('admin.calendar_events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.calendar_events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->calendarEvent->addEvent($request->all());

        return redirect()->route('backend.calendar_events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->calendarEvent->showEventById($id);

        return view('admin.calendar_events.show', compact('event'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->calendarEvent->showEventById($id);

        return view('admin.calendar_events.edit', compact('event'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int    $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->calendarEvent->editEvent($request->except('_method', '_token'), $id);

        return redirect()->route('backend.calendar_events.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->calendarEvent->deleteEvent($id);

        return response()->json(['done']);
    }
}
