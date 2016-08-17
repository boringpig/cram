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

	public function showUserActivityLog(int $user_id)
	{
		return $this->logRepository->getUserActivityLog($user_id);
	}

	public function showUserLatestLogin(int $user_id)
	{
		return $this->logRepository->getUserLatestLogin($user_id);
	}
}