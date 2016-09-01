<?php


namespace App\Repositories;


use App\Models\CalendarEvent;

class CalendarEventRepository extends AbstractRepository
{
	/** @var CalendarEvent $model */
	protected $model;

	/**
	 * CalendarEventRepository constructor.
	 *
	 * @param CalendarEvent $model
	 */
	public function __construct(CalendarEvent $model)
	{
		$this->model = $model;
		parent::__construct();
	}
}