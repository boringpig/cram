<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Role\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;

use Illuminate\Http\Request;

use App\Http\Requests;

class RoleController extends AdminController
{

    /**
     * @var RoleService
     */
    private $role;
    /**
     * @var PermissionService
     */
    private $permission;

    /**
     * RoleController constructor.
     *
     * @param RoleService $role
     * @param PermissionService $permission
     */
    public function __construct(RoleService $role, PermissionService $permission)
    {
        $this->role = $role;
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
        $roles = $this->role->showAllRole();

        return view('admin.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->showAllPermissionByArray();

        return view('admin.user.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->role->addRole($request->all());

        return redirect()->route('backend.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->showRoleById($id);

        return view('admin.user.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->showRoleById($id);
        $permissions = $this->permission->showAllPermissionByArray();

        return view('admin.user.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->role->editRole($request->except('_method', '_token'), $id);

        return redirect()->route('backend.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->deleteRole($id);
        return response()->json(['done']);
    }
}
