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

	public function showAllPermission()
	{
		return $this->permissionRepository->paginate(8);
	}

	public function showPermissionById(int $id)
	{
		return $this->permissionRepository->find($id);
	}

	public function showAllPermissionByArray()
	{
		$permissions =$this->permissionRepository->all();
		$perm = [];
		foreach ($permissions as $permission){
			$perm[$permission->id] = $permission->name;
		}

		return $perm;
	}

	public function addPermission(array $data)
	{
		return $this->permissionRepository->create($data);
	}

	public function editPermission(array $data, int $id)
	{
		return $this->permissionRepository->update($data, $id);
	}

	public function deletePermission(int $id)
	{
		return $this->permissionRepository->delete($id);
	}
}