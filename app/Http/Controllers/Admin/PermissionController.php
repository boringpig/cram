<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Permission\PermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;

use App\Http\Requests;

class PermissionController extends AdminController
{

    /**
     * @var PermissionService
     */
    private $permission;

    /**
     * PermissionController constructor.
     *
     * @param PermissionService $permission
     */
    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
        parent::__construct();
        $this->middleware('role:系統管理員|系統開發員');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->showAllPermission();

        return view('admin.user.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->permission->addPermission($request->all());

        return redirect()->route('backend.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permission->showPermissionById($id);

        return response()->json($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->showPermissionById($id);

        return view('admin.user.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->permission->editPermission($request->except('_method','_token'), $id);

        return redirect()->route('backend.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permission->deletePermission($id);

        return response()->json(['done']);
    }
}
