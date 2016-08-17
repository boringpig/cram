<?php


namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends AbstractRepository
{
	/** @var Tag $model Model物件 */
	protected $model;
	/**
	 * TagRepository constructor.
	 * @param $model
	 */
	public function __construct(Tag $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function getLatestTag()
	{
		return $this->model->latest()->paginate(5);
	}

}