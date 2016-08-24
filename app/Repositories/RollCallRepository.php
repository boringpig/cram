<?php


namespace App\Repositories;


use App\Models\RollCall;
use Carbon\Carbon;

class RollCallRepository extends AbstractRepository
{
	/** @var RollCall $model */
	protected $model;

	/**
	 * RollCallRepository constructor.
	 *
	 * @param RollCall $model
	 */
	public function __construct(RollCall $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function getRollCallData(RollCall $rollCall)
	{
		$weekArray = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
		$dt = new Carbon($rollCall->date);
		$week = $weekArray[$dt->dayOfWeek];
		$date = $dt->year. '/' . $dt->month . '/' . $dt->day . ' ' .$week . ' ' .$rollCall->class_time;
		$lesson = $rollCall->lesson()->first();
		$lesson_data = [];
		$student_data = [];
		$lesson_data [] = (object)['id' => $rollCall->id,
								   'lesson_id' => $rollCall->lesson_id,
			  					   'name' => $rollCall->name,
								   'teacher' => $rollCall->teacher,
								   'date' => $date,
								   'people' => count($lesson->students->all())];
		//原本就有在點名單上的學生
		foreach ($rollCall->students()->get() as $student){
			$student_data [] = (object) ['id'  => $student->id,
										 'name' => $student->name,
										 'status' => $student->pivot->status,
										 'description' => $student->pivot->description];
		}
		//後來加在班上的學生
		$students = $lesson->students()->where(function($q) {
			$q->where('status', 1)->orWhere('status', 2);
		})->get();
		foreach ($students as $student){
			$change = 0;
			foreach ($student_data as $data){
				$change = 1;
				if($data->id == $student->id) {
					$change = 0;
					break;
				}
			}
			if ($change){
				$student_data [] = (object) ['id'  => $student->id,
											 'name' => $student->name,
											 'status' => '',
											 'description' => ''];
			}
		}

		$result[] = (object)['班級' => $lesson_data, '學生' => $student_data];
		return $result;
	}

	public function createRollCall(array $data)
	{
		$rollCall = new RollCall();
		$rollCall->lesson_id = (int)$data['lesson'][0]['id'];
		$rollCall->name = $data['lesson'][0]['name'];
		$rollCall->teacher = $data['lesson'][0]['teacher'];
		$rollCall->class_time = trim($data['lesson'][0]['class_time']);
		$rollCall->date = new Carbon($data['lesson'][0]['date']);
		$rollCall->save();

		foreach ($data['student'] as $student){
			$rollCall->students()
				->attach((int)$student['id'], ['status' => (int)$student['status'], 'description' => $student['description']]);
		}

		return $rollCall;
	}

	public function updateRollCall(array $data)
	{
		$rollCall = $this->model->find($data['roll_call_id']);

		foreach ($data['student'] as $student){
			$rollCall->students()->detach((int)$student['id']);

			$rollCall->students()
				->attach((int)$student['id'], ['status' => (int)$student['status'], 'description' => $student['description']]);
		}

		return $rollCall;
	}
	/***** 後台管理 *****/
	public function getRollCallByDate(array $data)
	{
		$year = substr($data['date'], 0, 4);
		$month = substr($data['date'], 5, 6);
		$rollcall_array = [];

		$rollCalls = $this->model->whereYear('date', '=', $year)
								 ->whereMonth('date', '=', $month)
								 ->get();

		foreach ($rollCalls as $rollCall){

			$should_go = count($rollCall->students()->get());
			$real_go = count($rollCall->students()->wherePivot('status', 1)->get());
			$yet_go = $should_go - $real_go;
			$rollcall_array[] = (object) ['id' => $rollCall->id,
										'date' => Carbon::parse($rollCall->date)->format('Y/m/d'),
										'name' => $rollCall->name,
										'teacher' => $rollCall->teacher,
										'class_time' => $rollCall->class_time,
										'should_go' => $should_go,
										'real_go' => $real_go,
										'yet_go' => $yet_go];
		}

		return $rollcall_array;
	}

	public function getRollCallByLesson(array $data)
	{
		$rollCalls = $this->model->where('lesson_id', $data['lesson'])->get();
		$rollcall_array = [];

		foreach ($rollCalls as $rollCall){
			$should_go = count($rollCall->students()->get());
			$real_go = count($rollCall->students()->wherePivot('status', 1)->get());
			$yet_go = $should_go - $real_go;
			$rollcall_array[] = (object) ['id' => $rollCall->id,
										  'date' => Carbon::parse($rollCall->date)->format('Y/m/d'),
										  'name' => $rollCall->name,
										  'teacher' => $rollCall->teacher,
										  'class_time' => $rollCall->class_time,
										  'should_go' => $should_go,
										  'real_go' => $real_go,
										  'yet_go' => $yet_go];
		}

		return $rollcall_array;
	}

	public function updateRollCallById(array $data, int $id)
	{
		$rollCall = $this->model->find($id);

		foreach ($data['student'] as $student){
			$rollCall->students()->detach((int)$student['id']);

			$rollCall->students()
				->attach((int)$student['id'], ['status' => (int)$student['status'], 'description' => $student['description']]);
		}

		return $rollCall;
	}
}