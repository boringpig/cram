<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Student\StudentRequest;
use App\Services\LessonService;
use App\Services\StudentService;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends AdminController
{

    /**
     * @var StudentService
     */
    private $student;
    /**
     * @var LessonService
     */
    private $lesson;

    /**
     * StudentController constructor.
     *
     * @param StudentService $student
     * @param LessonService $lesson
     */
    public function __construct(StudentService $student, LessonService $lesson)
    {
        $this->student = $student;
        $this->lesson = $lesson;
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->student->showAllStudent();

        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson_list = $this->lesson->showAllLessonByArray();

        return view('admin.student.create', compact('lesson_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $this->student->addStudent($request->all());

        return redirect()->route('backend.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->student->showStudentById($id);

        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->student->showStudentById($id);
        $lesson_list = $this->lesson->showAllLessonByArray();

        return view('admin.student.edit', compact('student', 'lesson_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $this->student->editStudent($request->all(), $id);

        return redirect()->route('backend.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->student->deleteStudent($id);

        return response()->json(['done']);
    }
}
