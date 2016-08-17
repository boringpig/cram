<?php


namespace App\Services;


use App\Repositories\RoleRepository;

class RoleService
{

	/**
	 * @var RoleRepository
	 */
	private $roleRepository;

	/**
	 * RoleService constructor.
	 *
	 * @param RoleRepository $roleRepository
	 */
	public function __construct(RoleRepository $roleRepository)
	{
		$this->roleRepository = $roleRepository;
	}

	public function showAllRole()
	{
		return $this->roleRepository->paginate(8);
	}

	public function showAllRoleByArray()
	{
		$roles = $this->roleRepository->all();
		$role_list = [];
		foreach ($roles as $role){
			$role_list[$role->id] = $role->name;
		}

		return $role_list;
	}

	public function showRoleById(int $id)
	{
		return $this->roleRepository->find($id);
	}

	public function addRole(array $data)
	{
		return $this->roleRepository->createRole($data);
	}

	public function editRole(array $data, int $id)
	{
		return $this->roleRepository->updateRole($data, $id);
	}

	public function deleteRole(int $id)
	{
		return $this->roleRepository->deleteRole($id);
	}
}