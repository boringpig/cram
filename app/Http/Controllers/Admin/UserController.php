<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Services\LogService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends AdminController
{

    /**
     * @var UserService
     */
    private $user;
    /**
     * @var RoleService
     */
    private $role;
    /**
     * @var LogService
     */
    private $log;

    /**
     * UserController constructor.
     *
     * @param UserService $user
     * @param RoleService $role
     * @param LogService $log
     */
    public function __construct(UserService $user, RoleService $role, LogService $log)
    {
        $this->user = $user;
        $this->role = $role;
        $this->log = $log;
        parent::__construct();
        $this->middleware('role:系統管理員|系統開發員');
    }

	/**
     * 顯示全部使用者的使用記錄
     *
     * @return mixed
     */
    public function getAllUserActivityLog()
    {
        $logs = $this->log->showAllUserActivityLog();

        return view('admin.user.log', compact('logs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->showAllUser();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->showAllRoleByArray();

        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->user->addUser($request->all());

        return redirect()->route('backend.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->showUserById($id);
        $latest_login = $this->log->showUserLatestLogin($id);

        return view('admin.user.show', compact('user', 'latest_login'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->showUserById($id);
        $roles = $this->role->showAllRoleByArray();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditUserRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $this->user->editUser($request->except('_method','_token'),$id);

        return redirect()->route('backend.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->deleteUser($id);

        return response()->json(['done']);
    }
}
