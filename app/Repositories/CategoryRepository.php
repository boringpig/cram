<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends AbstractRepository
{
	/** @var Category $model Model物件 */
	protected $model;
	/**
	 * CategoryRepository constructor.
	 * @param $model
	 */
	public function __construct(Category $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function getLatestCategory()
	{
		return $this->model->latest()->paginate(5);
	}

}