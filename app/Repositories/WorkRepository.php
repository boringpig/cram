<?php


namespace App\Repositories;

use App\Models\ClockIn;
use App\Models\Work;

class WorkRepository extends AbstractRepository
{
	/** @var Work $model Model物件 */
	protected $model;
	/**
	 * WorkRepository constructor.
	 *
	 * @param Work $model
	 */
	public function __construct(Work $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 查詢最新工作
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getLatestWork()
	{
		return $this->model->latest()->paginate(5);
	}

	/**
	 * 一種工作可以attach多張工作表
	 *
	 * @param ClockIn $cardObj
	 * @param array $data
	 * @return null
	 */
	public function attachUserWork(ClockIn $cardObj, array $data)
	{
		$works = $data['work'];

		foreach ($works as $work){
			$work_type = (int)$work['type'];
			$work_hr = (int)$work['hr'];
			$cardObj->works()->attach($work_type, ['hour' => $work_hr]);
		}

		return null;

	}
}