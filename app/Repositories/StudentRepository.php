<?php


namespace App\Repositories;


use App\Models\Student;

class StudentRepository extends AbstractRepository
{

	/** @var Student $model */
	protected $model;

	/**
	 * StudentRepository constructor.
	 *
	 * @param Student $model
	 */
	public function __construct(Student $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function createStudent(array $data)
	{
		$student = new Student();
		$student->name = $data['name'];
		$student->graduated_school = $data['graduated_school'];
		$student->parent_name = $data['parent_name'];
		$student->status = $data['status'];
		$student->save();
		if (isset($data['lessons'])) {
			$student->lessons()->sync($data['lessons']);
		} else{
			$student->lessons()->sync(array());
		}

		return $student;
	}

	public function updateStudent(array $data, int $id)
	{
		$student = $this->model->find($id);
		$student->name = $data['name'];
		$student->graduated_school = $data['graduated_school'];
		$student->parent_name = $data['parent_name'];
		$student->status = $data['status'];
		$student->save();
		if (isset($data['lessons'])) {
			$student->lessons()->sync($data['lessons']);
		} else{
			$student->lessons()->sync(array());
		}

		return $student;
	}

	public function deleteStudent(int $id)
	{
		$student = $this->model->find($id);
		$student->lessons()->detach();
		return $student->delete();
	}
}