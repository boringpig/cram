<?php


namespace App\Repositories;


use App\Models\Lesson;
use Carbon\Carbon;

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

	/***** 點名管理 *****/
	public function getTodayAllRollCallLesson()
	{
		$weekArray = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
		$week = $weekArray[Carbon::today()->dayOfWeek];

		$lessons = $this->model->all();
		$lesson_list = [];

		foreach ($lessons as $lesson){
			foreach ($lesson->times()->get() as $time){
				if ($time->day == $week){
					array_push($lesson_list, $lesson);
				}
			}
		}

		return $lesson_list;
	}

	public function checkTodayRollCallLesson(array $data)
	{
		$lesson = $this->model->find($data['lesson']);
		$rollCall = $lesson->rollCalls()->whereDate('date', '=', Carbon::today()->toDateString())->first();

		return $rollCall;
	}

	public function getLessonAndStudent(array $data)
	{
		$weekArray = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
		$week = $weekArray[Carbon::today()->dayOfWeek];
		$date =  Carbon::today()->year . '/' .Carbon::today()->month . '/' . Carbon::today()->day;
		$lesson = $this->model->find($data['lesson']);
		$lesson_data = [];
		$student_data = [];
		foreach ($lesson->times()->get() as $time){
			if ($time->day == $week){
				$start_time = Carbon::parse($time->start_time)->format('H:i');
				$end_time = Carbon::parse($time->end_time)->format('H:i');
				$date = $date . ' ' .$week . ' ' . $start_time . '~' .$end_time;
			}
		}
		//只能該班的試聽生、在班生才可以點名
		$students = $lesson->students()->where(function($q) {
					$q->where('status', 1)->orWhere('status', 2);
		})->get();
		foreach ($students as $student){
			$student_data [] = (object)['id' => $student->id,
										'name' => $student->name,
										'status' => '',
										'description' => ''];
		}

		$lesson_data [] = (object)['id' => 0,
								   'lesson_id' => $lesson->id,
								   'name' => $lesson->grade->name . ' ' .$lesson->name,
								   'teacher' => $lesson->user->name,
								   'date' => $date,
								   'people' => count($lesson->students->all())];

		$result[] = (object)['班級' => $lesson_data,'學生' => $student_data];
		return $result;
	}

}