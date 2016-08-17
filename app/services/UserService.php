<?php


namespace App\Services;

use App\Repositories\ClockInRepository;
use App\Repositories\UserRepository;
use App\Traits\Log;
use Auth;
use Carbon\Carbon;
use Session;

class UserService
{

	use Log;
	/**
	 * @var UserRepository
	 */
	private $userRepository;
	/**
	 * @var ClockInRepository
	 */
	private $clockInRepository;

	/**
	 * UserService constructor.
	 *
	 * @param UserRepository $userRepository
	 * @param ClockInRepository $clockInRepository
	 */
	public function __construct(UserRepository $userRepository, ClockInRepository $clockInRepository)
	{
		$this->userRepository = $userRepository;
		$this->clockInRepository = $clockInRepository;
	}


	/**
	 * 查詢使用者的ＩＤ
	 *
	 * @param int $user_id
	 * @return mixed
	 */
	public function showUserById(int $user_id)
	{
		return $this->userRepository->find($user_id);
	}

	/**
	 * 重設使用者密碼
	 *
	 * @param array $data
	 * @param $userObj
	 * @return null
	 */
	public function resetUserPassword(array $data, $userObj)
	{
		$result = $this->userRepository->updateUserPassword($data, $userObj);
		if ($result) {
			$this->logUserAccount('重設密碼', '密碼變更成功', []);
			Session::flash('success', '密碼變更成功');
		} else {
			$this->logUserAccount('重設密碼', '密碼變更失敗', []);
			Session::flash('error', '與原本設定的密碼不相符');
		}

		return null;
	}

	/**
	 * 更新使用者檔案
	 *
	 * @param array $data
	 * @param $userId
	 * @param $userIP
	 * @return bool
	 */
	public function editUserProfile(array $data, $userId, $userIP) : bool
	{
		if (Auth::user()->id != $userId) {
			$properties = ['status' => '非本人修改他人資料', 'input' => $userId, 'ip' => $userIP];
			$this->logUserAccount('個人檔案修改', '修改個人資料失敗', $properties);
			Session::flash('error', '非本人請勿擅自更改他人資料!');

			return false;
		}
		$user = $this->userRepository->update($data, $userId);
		if ($user) {
			$this->logUserAccount('個人檔案修改', '修改個人資料成功', []);
			Session::flash('success', '成功修改個人資料!');

			return true;
		} else {
			$properties = ['status' => '沒有該帳號', 'input' => $userId, 'ip' => $userIP];
			$this->logUserAccount('個人檔案修改', '修改個人資料失敗', $properties);
			Session::flash('error', '沒有該帳號!');

			return false;
		}
	}

	public function showUserAllClockCardByLatest()
	{
		$user_id = Auth::user()->id;

		return $this->userRepository->getUserAllClockCardLatest($user_id);
	}

	public function showUserSelectMonth()
	{
		$user_id = Auth::user()->id;

		return $this->userRepository->getUserSelectMonth($user_id);
	}

	public function showUserClockMonth(array $data)
	{
		$user_id = Auth::user()->id;

		return $this->userRepository->getUserClockMonth($data, $user_id);
	}

	public function showUserLatestClock()
	{
		$user_id = Auth::user()->id;

		return $this->userRepository->getUserLatestClock($user_id);
	}

	public function postUserClockIn()
	{
		return $this->clockInRepository->UserClockIn(Carbon::now(),Auth::user());
	}

	public function postUserClockOut(array $data)
	{
		return $this->clockInRepository->UserClockOut(Carbon::now(), $data);
	}

	/*****************************後台管理*********************************/
	//所有會員
	public function showAllUser()
	{
		$users = $this->userRepository->paginate(8);

		return $users;
	}

	public function addUser(array $data)
	{
		$this->userRepository->createUser($data);
		Session::flash('success', '新增會員帳號成功');

		return null;
	}

	public function editUser(array $data, int $id)
	{
		return $this->userRepository->updateUser($data, $id);
	}

	public function deleteUser(int $id)
	{
		return $this->userRepository->delete($id);
	}

	//所有工讀生
	public function showAllServitor()
	{
		return $this->userRepository->getAllServitor();
	}

	public function showServitorClockInLog(int $id)
	{
		return $this->userRepository->getServitorClockInLog($id);
	}

	public function showAllServitorClockMonth(array $data)
	{
		return $this->userRepository->getAllServitorClockMonth($data);
	}
}