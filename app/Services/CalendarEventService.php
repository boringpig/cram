<?php


namespace App\Services;

use App\Repositories\CalendarEventRepository;
use Illuminate\Database\Eloquent\Collection;

class CalendarEventService
{

	/**
	 * @var CalendarEventRepository
	 */
	private $calendarEventRepository;

	/**
	 * CalendarEventService constructor.
	 *
	 * @param CalendarEventRepository $calendarEventRepository
	 */
	public function __construct(CalendarEventRepository $calendarEventRepository)
	{
		$this->calendarEventRepository = $calendarEventRepository;
	}


	/**
	 * 顯示全部的日曆事件
	 *
	 * @return Collection
	 */
	public function showAllEvent() : Collection
	{
		return $this->calendarEventRepository->all();
	}


	/**
	 * 新增事件
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addEvent(array $data)
	{
		return $this->calendarEventRepository->create($data);
	}

	/**
	 * 尋找特定單一事件
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function showEventById(int $id)
	{
		return $this->calendarEventRepository->find($id);
	}

	/**
	 * 編輯事件
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function editEvent(array $data, int $id)
	{
		return $this->calendarEventRepository->update($data, $id);
	}

	/**
	 * 刪除事件
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteEvent(int $id)
	{
		return $this->calendarEventRepository->delete($id);
	}

}