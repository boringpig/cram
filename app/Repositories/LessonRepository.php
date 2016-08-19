<?php


namespace App\Repositories;


use App\Models\Lesson;

class LessonRepository extends AbstractRepository
{
	/** @var Lesson $model */
	protected $model;

	/**
	 * LessonRepository constructor.
	 *
	 * @param Lesson $model
	 */
	public function __construct(Lesson $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function createLesson(array $data)
	{
		$lesson = new Lesson();
		$lesson->grade_id = $data['grade_id'];
		$lesson->user_id = $data['user_id'];
		$lesson->classNo = $data['classNo'];
		$lesson->name = $data['name'];
		$lesson->description = $data['description'];
		$lesson->published_date = $data['published_date'];
		$lesson->save();

		if(isset($data['times'])){
			$lesson->times()->sync($data['times']);
		} else{
			$lesson->times()->sync(array());
		}

		return $lesson;
	}

	public function updateLesson(array $data, int $id)
	{
		$lesson = $this->model->find($id);
		$lesson->grade_id = $data['grade_id'];
		$lesson->user_id = $data['user_id'];
		$lesson->classNo = $data['classNo'];
		$lesson->name = $data['name'];
		$lesson->description = $data['description'];
		$lesson->published_date = $data['published_date'];
		$lesson->save();

		if(isset($data['times'])){
			$lesson->times()->sync($data['times']);
		} else{
			$lesson->times()->sync(array());
		}

		return $lesson;
	}

	public function deleteLesson(int $id)
	{
		$lesson = $this->model->find($id);
		$lesson->times()->detach();
		return $lesson->delete();
	}
}