<?php


namespace App\Repositories;


use App\Models\Grade;

class GradeRepository extends AbstractRepository
{
	/** @var Grade $model Model物件 */
	protected $model;

	/**
	 * GradeRepository constructor.
	 *
	 * @param Grade $model
	 */
	public function __construct(Grade $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function getLatestAllGrade()
	{
		return $this->model->latest()->paginate(8);
	}
}