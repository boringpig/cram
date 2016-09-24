<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServitorController extends AdminController
{

    /**
     * @var UserService
     */
    private $user;

    /**
     * ServitorController constructor.
     *
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        $this->user = $user;
        parent::__construct();
        $this->middleware('role:系統管理員|系統開發員');
    }

    public function getClockView()
    {
        return view('admin.servitor.view-month');
    }

    public function ajax_postClockMonth(Request $request)
    {
        $card_month = $this->user->showAllServitorClockMonth($request->all());

        return response()->json($card_month);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servitors = $this->user->showAllServitor();

        return view('admin.servitor.index', compact('servitors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servitor_clocks = $this->user->showServitorClockInLog($id);

        return view('admin.servitor.show', compact('servitor_clocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
