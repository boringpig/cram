<?php


namespace App\Services;


use App\Repositories\GradeRepository;

class GradeService
{

	/**
	 * @var GradeRepository
	 */
	private $gradeRepository;

	/**
	 * GradeService constructor.
	 *
	 * @param GradeRepository $gradeRepository
	 */
	public function __construct(GradeRepository $gradeRepository)
	{
		$this->gradeRepository = $gradeRepository;
	}

	/**
	 * 用陣列顯示全部的年級
	 *
	 * @return array
	 */
	public function showAllGradeByArray()
	{
		$grades = $this->gradeRepository->all();
		$grade_list = [];
		foreach ($grades as $grade){
			$grade_list[$grade->id] = $grade->name;
		}

		return $grade_list;
	}

	/**
	 * 顯示全部的年級
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showLatestAllGrade()
	{
		return $this->gradeRepository->getLatestAllGrade();
	}

	/**
	 * 新增年級
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addGrade(array $data)
	{
		return $this->gradeRepository->create($data);
	}

	/**
	 * 編輯年級
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function editGrade(array $data,int $id)
	{
		return $this->gradeRepository->update($data, $id);
	}

	/**
	 * 刪除年級
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteGrade(int $id)
	{
		return $this->gradeRepository->delete($id);
	}
}