<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\EditProfileRequest;
use App\Http\Requests\User\UserAvatarRequest;
use App\Services\LogService;
use App\Services\UserService;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * @var UserService
	 */
	private $user;
	/**
	 * @var LogService
	 */
	private $log;

	/**
	 * UserController constructor.
	 *
	 * @param UserService $user
	 * @param LogService $log
	 * @internal param UserService $userService
	 * @internal param UserRepository $user
	 * @internal param ActivityRepository $activity
	 */
	public function __construct(UserService $user, LogService $log)
	{
		$this->user = $user;
		$this->log = $log;
	}

	/**
	 * 顯示個人的使用記錄
	 *
	 * @return mixed
	 */
	public function getUserActivityLog()
	{
		$user_id = Auth::user()->id;
		$activities = $this->log->showUserActivityLog($user_id);

		return view('user.activity-list', compact('activities'));
	}

	/**
	 * 顯示編輯個人基本資料
	 *
	 * @return mixed
	 */
	public function getEditUser()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->showUserById($user_id);
		$avatar_url = $this->user->showUserAvatar($user_id);

		return view('user.profile', compact('user', 'avatar_url'));
	}

	/**
	 * 顯示更改個人密碼
	 *
	 * @return mixed
	 */
	public function getChangePassword()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->showUserById($user_id);

		return view('user.setting', compact('user'));
	}

	/**
	 * 更改個人密碼
	 *
	 * @param ChangePasswordRequest $request
	 * @return mixed
	 */
	public function postChangePassword(ChangePasswordRequest $request)
	{
		$user = Auth::user();
		$this->user->resetUserPassword($request->except('_method','_token'), $user);

		return redirect()->back();
	}

	/**
	 * 編輯個人基本資料
	 *
	 * @param EditProfileRequest $request
	 * @param $id
	 * @return mixed
	 */
	public function postEditUser(EditProfileRequest $request, $id)
	{
		$result = $this->user->editUserProfile($request->except('_method','_token'), $id, $request->ip());
		if (!$result){
			return redirect()->route('home');
		}
		return redirect()->route('user.profile');
	}

	/**
	 * 更改個人帳戶大頭貼
	 *
	 * @param UserAvatarRequest $request
	 * @return mixed
	 */
	public function postUserAvatar(UserAvatarRequest $request)
	{
		$this->user->UploadUserAvatar($request->allFiles());

		return redirect()->back();
	}

	/*****************************上班打卡*********************************/

	/**
	 * 顯示上班打卡
	 *
	 * @return mixed
	 */
	public function getClockIndex()
	{
		return view('clockin.index');
	}

	/**
	 * 顯示個人打卡記錄
	 *
	 * @return mixed
	 */
	public function getClockLog()
	{
		$cards = $this->user->showUserAllClockCardByLatest();

		return view('clockin.log', compact('cards'));
	}

	/**
	 * 顯示查詢打卡月份
	 *
	 * @return mixed
	 */
	public function getClockView()
	{
		$months = $this->user->showUserSelectMonth();

		return view('clockin.view-month', compact('months'));
	}

	/**
	 * AJAX查詢打卡月份
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function ajax_postClockMonth(Request $request)
	{
		$card_month = $this->user->showUserClockMonth($request->all());

		return response()->json($card_month);
	}

	/**
	 * AJAX查詢使用者的打卡狀況
	 *
	 * @return mixed
	 */
	public function getClockStatus()
	{
		$status = $this->user->showUserLatestClock();

		return response()->json($status);
	}

	/**
	 * 上班打卡
	 *
	 * @return mixed
	 */
	public function postUserClockIn()
	{
		$work = $this->user->postUserClockIn();

		return response()->json($work);
	}

	/**
	 * 下班打卡
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function postUserClockOut(Request $request)
	{
		$work = $this->user->postUserClockOut($request->all());

		return response()->json($work);
	}
}
