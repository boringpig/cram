<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServitorController extends Controller
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