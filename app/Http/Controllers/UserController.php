<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class UserController extends Controller
{

	/**
	 * @var UserRepository
	 */
	private $user;


	/**
	 * UserController constructor.
	 *
	 * @param UserRepository $user
	 */
	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	public function getEditUser()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->find($user_id);

		return view('user.profile', compact('user'));
	}

	public function getChangePassword()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->find($user_id);

		return view('user.setting', compact('user'));
	}

	public function postChangePassword(ChangePasswordRequest $request)
	{
		$user = Auth::user();
		$result = $this->user->updateUserPassword($request->except('_method','_token'), $user);
		if(!$result){
			Session::flash('error', '目前密碼輸入錯誤');
			return redirect()->back();
		}
		Session::flash('success', '密碼變更成功');
		return redirect()->back();
	}

	public function postEditUser(Request $request, $id)
	{
		$this->validate($request, [
				'name'  => 'required',
				'email' => 'required|email'
			]);

		if(Auth::user()->id != $id){
			Session::flash('error', '非本人請勿擅自更改他人資料!');
			return redirect()->route('home');
		}
		$checkUser = $this->user->updateUserProfile($request->except('_method','_token'), $id);
		if (!$checkUser){
			Session::flash('error', '沒有該帳號!');
			return redirect()->route('home');
		}
		Session::flash('success', '成功修改個人資料!');
		return redirect()->route('user.profile');
	}
}
