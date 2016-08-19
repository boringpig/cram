<?php


namespace App\Repositories;


use App\Models\Time;
use Carbon\Carbon;

class TimeRepository extends AbstractRepository
{
	/** @var Time $model */
	protected $model;

	/**
	 * TimeRepository constructor.
	 *
	 * @param Time $model
	 */
	public function __construct(Time $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function getLatestAllTime()
	{
		return $this->model->latest()->paginate(8);
	}

	public function createTime(array $data)
	{
		$time = new Time();
		$time->day = $data['day'];
		$time->start_time = Carbon::createFromFormat('g:i A', $data['start_time'])->toTimeString();
		$time->end_time = Carbon::createFromFormat('g:i A', $data['end_time'])->toTimeString();
		$time->save();

		return $time;
	}

	public function updateTime(array $data, int $id)
	{
		$time = $this->model->find($id);
		$time->day = $data['day'];
		$time->start_time = Carbon::createFromFormat('g:i A', $data['start_time'])->toTimeString();
		$time->end_time = Carbon::createFromFormat('g:i A', $data['end_time'])->toTimeString();
		$time->save();

		return $time;
	}
}