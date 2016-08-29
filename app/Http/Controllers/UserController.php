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

	public function getUserActivityLog()
	{
		$user_id = Auth::user()->id;
		$activities = $this->log->showUserActivityLog($user_id);

		return view('user.activity-list', compact('activities'));
	}

	public function getEditUser()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->showUserById($user_id);
		$avatar_url = $this->user->showUserAvatar($user_id);

		return view('user.profile', compact('user', 'avatar_url'));
	}

	public function getChangePassword()
	{
		$user_id = Auth::user()->id;
		$user = $this->user->showUserById($user_id);

		return view('user.setting', compact('user'));
	}

	public function postChangePassword(ChangePasswordRequest $request)
	{
		$user = Auth::user();
		$this->user->resetUserPassword($request->except('_method','_token'), $user);

		return redirect()->back();
	}

	public function postEditUser(EditProfileRequest $request, $id)
	{
		$result = $this->user->editUserProfile($request->except('_method','_token'), $id, $request->ip());
		if (!$result){
			return redirect()->route('home');
		}
		return redirect()->route('user.profile');
	}

	public function postUserAvatar(UserAvatarRequest $request)
	{
		$this->user->UploadUserAvatar($request->allFiles());

		return redirect()->back();
	}

	/*****************************上班打卡*********************************/

	public function getClockIndex()
	{
		return view('clockin.index');
	}

	public function getClockLog()
	{
		$cards = $this->user->showUserAllClockCardByLatest();

		return view('clockin.log', compact('cards'));
	}

	public function getClockView()
	{
		$months = $this->user->showUserSelectMonth();

		return view('clockin.view-month', compact('months'));
	}

	public function ajax_postClockMonth(Request $request)
	{
		$card_month = $this->user->showUserClockMonth($request->all());

		return response()->json($card_month);
	}

	public function getClockStatus()
	{
		$status = $this->user->showUserLatestClock();

		return response()->json($status);
	}

	public function postUserClockIn()
	{
		$work = $this->user->postUserClockIn();

		return response()->json($work);
	}

	public function postUserClockOut(Request $request)
	{
		$work = $this->user->postUserClockOut($request->all());

		return response()->json($work);
	}
}
