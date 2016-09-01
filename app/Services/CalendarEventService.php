<?php


namespace App\Services;

use App\Repositories\CalendarEventRepository;

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

	public function showAllEvent()
	{
		return $this->calendarEventRepository->all();
	}

	public function addEvent(array $data)
	{
		return $this->calendarEventRepository->create($data);
	}

	public function showEventById(int $id)
	{
		return $this->calendarEventRepository->find($id);
	}

	public function editEvent(array $data, int $id)
	{
		return $this->calendarEventRepository->update($data, $id);
	}

	public function deleteEvent(int $id)
	{
		return $this->calendarEventRepository->delete($id);
	}

}