<?php


namespace App\Repositories;


use App\Models\Role;

class RoleRepository extends AbstractRepository
{
	/** @var Role $model Model物件 */
	protected $model;
	/**
	 * RoleRepository constructor.
	 * @param $model
	 */
	public function __construct(Role $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 新增角色
	 *
	 * @param array $data
	 * @return Role
	 */
	public function createRole(array $data)
	{
		$role = new Role();
		$role->name = $data['name'];
		$role->display_name = $data['display_name'];
		$role->description = $data['description'];
		$role->save();
		if (isset($data['permissions'])) {
			$role->permissions()->sync($data['permissions']);
		} else {
			$role->permissions()->sync(array());
		}

		return $role;
	}

	/**
	 * 編輯角色
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function updateRole(array $data, int $id)
	{
		$role = $this->model->find($id);
		$role->name = $data['name'];
		$role->display_name = $data['display_name'];
		$role->description = $data['description'];
		$role->save();
		if (isset($data['permissions'])) {
			$role->permissions()->sync($data['permissions']);
		} else {
			$role->permissions()->sync(array());
		}

		return $role;
	}

	/**
	 * 刪除角色
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function deleteRole(int $id)
	{
		return $this->model->where('id', $id)->delete();
	}

}