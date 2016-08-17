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

	public function showAllWork()
	{
		return $this->workRepository->all();
	}

	public function showLatestWork()
	{
		return $this->workRepository->getLatestWork();
	}

	public function addWork(array $data)
	{
		return $this->workRepository->create($data);
	}

	public function updateWork(array $data, int $id)
	{
		return $this->workRepository->update($data, $id);
	}

	public function deleteWork(int $id)
	{
		return $this->workRepository->delete($id);
	}

	public function addUserClockOutWork(array $data)
	{
		$card = $this->clockInRepository->find($data['card_id']);

		return $this->workRepository->attachUserWork($card, $data);
	}
}