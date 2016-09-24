<?php


namespace App\Services;


use App\Repositories\LogRepository;

class LogService
{

	/**
	 * @var LogRepository
	 */
	private $logRepository;


	/**
	 * LogService constructor.
	 *
	 * @param LogRepository $logRepository
	 */
	public function __construct(LogRepository $logRepository)
	{
		$this->logRepository = $logRepository;
	}

	/**
	 * 顯示全部使用者的使用記錄
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showAllUserActivityLog()
	{
		return $this->logRepository->getAllUserActivityLog();
	}

	/**
	 * 顯示特定使用者的使用記錄
	 *
	 * @param int $user_id
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showUserActivityLog(int $user_id)
	{
		return $this->logRepository->getUserActivityLog($user_id);
	}

	/**
	 * 顯示使用者最近登入時間
	 *
	 * @param int $user_id
	 * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
	 */
	public function showUserLatestLogin(int $user_id)
	{
		return $this->logRepository->getUserLatestLogin($user_id);
	}
}