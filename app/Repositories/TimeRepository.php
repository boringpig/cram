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

	/**
	 * 查詢全部的課程時間
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getLatestAllTime()
	{
		return $this->model->latest()->paginate(8);
	}

	/**
	 * 建立課程時間
	 *
	 * @param array $data
	 * @return Time
	 */
	public function createTime(array $data)
	{
		$time = new Time();
		$time->day = $data['day'];
		$time->start_time = Carbon::createFromFormat('g:i A', $data['start_time'])->toTimeString();
		$time->end_time = Carbon::createFromFormat('g:i A', $data['end_time'])->toTimeString();
		$time->save();

		return $time;
	}

	/**
	 * 更新課程時間
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
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