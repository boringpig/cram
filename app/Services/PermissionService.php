<?php


namespace App\Services;


use App\Repositories\PermissionRepository;

class PermissionService
{

	/**
	 * @var PermissionRepository
	 */
	private $permissionRepository;

	/**
	 * PermissionService constructor.
	 *
	 * @param PermissionRepository $permissionRepository
	 */
	public function __construct(PermissionRepository $permissionRepository)
	{
		$this->permissionRepository = $permissionRepository;
	}

	/**
	 * 顯示全部的職權工作
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function showAllPermission()
	{
		return $this->permissionRepository->paginate(8);
	}

	/**
	 * 查詢單一的職權工作
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function showPermissionById(int $id)
	{
		return $this->permissionRepository->find($id);
	}

	/**
	 * 用陣列顯示全部的職權工作
	 *
	 * @return array
	 */
	public function showAllPermissionByArray()
	{
		$permissions =$this->permissionRepository->all();
		$perm = [];
		foreach ($permissions as $permission){
			$perm[$permission->id] = $permission->name;
		}

		return $perm;
	}

	/**
	 * 新增職權工作
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addPermission(array $data)
	{
		return $this->permissionRepository->create($data);
	}

	/**
	 * 編輯職權工作
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function editPermission(array $data, int $id)
	{
		return $this->permissionRepository->update($data, $id);
	}

	/**
	 * 刪除職權工作
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deletePermission(int $id)
	{
		return $this->permissionRepository->delete($id);
	}
}