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

	public function showAllGradeByArray()
	{
		$grades = $this->gradeRepository->all();
		$grade_list = [];
		foreach ($grades as $grade){
			$grade_list[$grade->id] = $grade->name;
		}

		return $grade_list;
	}

	public function showLatestAllGrade()
	{
		return $this->gradeRepository->getLatestAllGrade();
	}

	public function addGrade(array $data)
	{
		return $this->gradeRepository->create($data);
	}

	public function editGrade(array $data,int $id)
	{
		return $this->gradeRepository->update($data, $id);
	}

	public function deleteGrade(int $id)
	{
		return $this->gradeRepository->delete($id);
	}
}