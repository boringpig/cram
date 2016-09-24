<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Services\GradeService;
use Illuminate\Http\Request;

use App\Http\Requests;

class GradeController extends AdminController
{

    /**
     * @var GradeService
     */
    private $grade;

    /**
     * GradeController constructor.
     *
     * @param GradeService $grade
     */
    public function __construct(GradeService $grade)
    {
        parent::__construct();
        $this->grade = $grade;
        $this->middleware('permission:系統管理|班級事務');
    }


    public function manageGrade()
    {
        return view('admin.lesson.grade.manageGrade');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = $this->grade->showLatestAllGrade();

        return response()->json($grades);
    }

    public function store(Request $request)
    {
        $grade = $this->grade->addGrade($request->all());

        return response()->json($grade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grade = $this->grade->editGrade($request->except('_method', '_token'), $id);

        return response()->json($grade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->grade->deleteGrade($id);

        return response()->json(['done']);
    }
}
