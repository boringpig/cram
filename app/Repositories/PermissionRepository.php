<?php


namespace App\Repositories;


use App\Models\Permission;

class PermissionRepository extends AbstractRepository
{
	/** @var Permission $model Model物件 */
	protected $model;

	/**
	 * PermissionRepository constructor.
	 *
	 * @param Permission $model
	 */
	public function __construct(Permission $model)
	{
		$this->model = $model;
		parent::__construct();
	}
}