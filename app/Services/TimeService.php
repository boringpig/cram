<?php


namespace App\Services;


use App\Repositories\TimeRepository;

class TimeService
{

	/**
	 * @var TimeRepository
	 */
	private $timeRepository;

	/**
	 * TimeService constructor.
	 *
	 * @param TimeRepository $timeRepository
	 */
	public function __construct(TimeRepository $timeRepository)
	{
		$this->timeRepository = $timeRepository;
	}

	public function showAllTimeByArray()
	{
		$times = $this->timeRepository->all();
		$time_list = [];

		foreach ($times as $time){
			$time_list[$time->id] = $time->day .' ' .$time->start_time . '~' . $time->end_time;
		}

		return $time_list;
	}

	public function showLatestAllTime()
	{
		return $this->timeRepository->getLatestAllTime();
	}

	public function addTime(array $data)
	{
		return $this->timeRepository->createTime($data);
	}

	public function editTime(array $data, int $id)
	{
		return $this->timeRepository->updateTime($data, $id);
	}

	public function deleteTime(int $id)
	{
		return $this->timeRepository->delete($id);
	}

}