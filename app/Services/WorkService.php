<?php


namespace App\Services;


use App\Repositories\ClockInRepository;
use App\Repositories\WorkRepository;

class WorkService
{

	/**
	 * @var WorkRepository
	 */
	private $workRepository;
	/**
	 * @var ClockInRepository
	 */
	private $clockInRepository;

	/**
	 * WorkService constructor.
	 *
	 * @param WorkRepository $workRepository
	 * @param ClockInRepository $clockInRepository
	 */
	public function __construct(WorkRepository $workRepository, ClockInRepository $clockInRepository)
	{
		$this->workRepository = $workRepository;
		$this->clockInRepository = $clockInRepository;
	}

	/**
	 * 顯示全部工作
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function showAllWork()
	{
		return $this->workRepository->all();
	}

	/**
	 * 顯示最新工作
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showLatestWork()
	{
		return $this->workRepository->getLatestWork();
	}

	/**
	 * 新增工作
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addWork(array $data)
	{
		return $this->workRepository->create($data);
	}

	/**
	 * 更新工作
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function updateWork(array $data, int $id)
	{
		return $this->workRepository->update($data, $id);
	}

	/**
	 * 刪除工作
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteWork(int $id)
	{
		return $this->workRepository->delete($id);
	}

	/**
	 * 新增打卡下班的工作
	 *
	 * @param array $data
	 * @return null
	 */
	public function addUserClockOutWork(array $data)
	{
		$card = $this->clockInRepository->find($data['card_id']);

		return $this->workRepository->attachUserWork($card, $data);
	}
}