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

	/**                     
	 * 顯示全部的角色
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function showAllRole()
	{
		return $this->roleRepository->paginate(8);
	}

	/**                
	 * 用陣列顯示全部的角色
	 * 
	 * @return array
	 */
	public function showAllRoleByArray()
	{
		$roles = $this->roleRepository->all();
		$role_list = [];
		foreach ($roles as $role){
			$role_list[$role->id] = $role->name;
		}

		return $role_list;
	}

	/**                   
	 * 查詢單一角色
	 * 
	 * @param int $id
	 * @return mixed
	 */
	public function showRoleById(int $id)
	{
		return $this->roleRepository->find($id);
	}

	/**              
	 * 新增角色
	 * 
	 * @param array $data
	 * @return \App\Models\Role
	 */
	public function addRole(array $data)
	{
		return $this->roleRepository->createRole($data);
	}

	/**                   
	 * 編輯角色
	 * 
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function editRole(array $data, int $id)
	{
		return $this->roleRepository->updateRole($data, $id);
	}

	/**                 
	 * 刪除角色
	 * 
	 * @param int $id
	 * @return mixed
	 */
	public function deleteRole(int $id)
	{
		return $this->roleRepository->deleteRole($id);
	}
}