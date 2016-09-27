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

	/**
	 * 用陣列顯示全部的課程時間
	 *
	 * @return array
	 */
	public function showAllTimeByArray()
	{
		$times = $this->timeRepository->all();
		$time_list = [];

		foreach ($times as $time){
			$time_list[$time->id] = $time->day .' ' .$time->start_time . '~' . $time->end_time;
		}

		return $time_list;
	}

	/**
	 * 顯示全部的課程時間
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showLatestAllTime()
	{
		return $this->timeRepository->getLatestAllTime();
	}

	/**
	 * 新增課程時間
	 *
	 * @param array $data
	 * @return \App\Models\Time
	 */
	public function addTime(array $data)
	{
		return $this->timeRepository->createTime($data);
	}

	/**
	 * 編輯課程時間
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function editTime(array $data, int $id)
	{
		return $this->timeRepository->updateTime($data, $id);
	}

	/**
	 * 刪除課程時間
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteTime(int $id)
	{
		return $this->timeRepository->delete($id);
	}

}