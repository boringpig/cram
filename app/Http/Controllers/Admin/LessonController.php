<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Lesson\LessonRequest;
use App\Services\GradeService;
use App\Services\LessonService;
use App\Services\TimeService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;

class LessonController extends AdminController
{

    /**
     * @var GradeService
     */
    private $grade;
    /**
     * @var UserService
     */
    private $user;
    /**
     * @var TimeService
     */
    private $time;
    /**
     * @var LessonService
     */
    private $lesson;

    /**
     * LessonController constructor.
     *
     * @param LessonService $lesson
     * @param GradeService $grade
     * @param UserService $user
     * @param TimeService $time
     */
    public function __construct(LessonService $lesson, GradeService $grade, UserService $user, TimeService $time)
    {
        $this->lesson = $lesson;
        $this->grade = $grade;
        $this->user = $user;
        $this->time = $time;
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = $this->lesson->showAllLesson();

        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grade_list = $this->grade->showAllGradeByArray();
        $teacher_list = $this->user->showAllTeacher();
        $time_list = $this->time->showAllTimeByArray();

        return view('admin.lesson.create', compact('grade_list', 'teacher_list', 'time_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        $this->lesson->addLesson($request->all());

        return redirect()->route('backend.lessons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = $this->lesson->showLessonById($id);

        return view('admin.lesson.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = $this->lesson->showLessonById($id);
        $grade_list = $this->grade->showAllGradeByArray();
        $teacher_list = $this->user->showAllTeacher();
        $time_list = $this->time->showAllTimeByArray();

        return view('admin.lesson.edit', compact('lesson', 'grade_list', 'teacher_list', 'time_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $id)
    {
        $this->lesson->editLesson($request->except('_method', '_token'), $id);

        return redirect()->route('backend.lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->lesson->deleteLesson($id);

        return response()->json(['done']);
    }
}
