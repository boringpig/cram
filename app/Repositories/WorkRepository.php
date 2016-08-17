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

	public function getLatestWork()
	{
		return $this->model->latest()->paginate(5);
	}

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