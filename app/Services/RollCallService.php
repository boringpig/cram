<?php


namespace App\Services;


use App\Repositories\LessonRepository;
use App\Repositories\RollCallRepository;

class RollCallService
{

	/**
	 * @var LessonRepository
	 */
	private $lessonRepository;
	/**
	 * @var RollCallRepository
	 */
	private $rollCallRepository;

	/**
	 * RollCallService constructor.
	 *
	 * @param RollCallRepository $rollCallRepository
	 * @param LessonRepository $lessonRepository
	 */
	public function __construct(RollCallRepository $rollCallRepository, LessonRepository $lessonRepository)
	{
		$this->lessonRepository = $lessonRepository;
		$this->rollCallRepository = $rollCallRepository;
	}

	public function showTodayAllRollCallLesson()
	{
		return $this->lessonRepository->getTodayAllRollCallLesson();
	}

	public function showRollCallLesson(array $data)
	{
		//1.先搜尋當天該班級是否有點名紀錄
		$rollCall = $this->lessonRepository->checkTodayRollCallLesson($data);
		if(count($rollCall) > 0) {
			//2.如果有回傳當天的點名狀況(該班資訊、學生出缺席)
			return $this->rollCallRepository->getRollCallData($rollCall);
		}

		//3.如果沒有回傳該班級的資料及學生(該班資訊、該班的學生)
		return $this->lessonRepository->getLessonAndStudent($data);
	}

	public function ajax_RollCallLesson(array $data)
	{
		if ((int)$data['roll_call_id'] != 0){
			return $this->rollCallRepository->updateRollCall($data);
		}

		return $this->rollCallRepository->createRollCall($data);
	}

	public function showRollCallLessonByArray()
	{
		$rollCalls = $this->rollCallRepository->all();
		$lesson_list = [];

		foreach ($rollCalls as $rollCall){
			$lesson_list[] = (object)[
				'id'   => $rollCall->lesson->id,
				'name' => $rollCall->name
			];
		}

		return $lesson_list;
	}

	public function showRollCallByDate(array $data)
	{
		return $this->rollCallRepository->getRollCallByDate($data);
	}

	public function showRollCallByLesson(array $data)
	{
		return $this->rollCallRepository->getRollCallByLesson($data);
	}

	public function showRollCallById(int $id)
	{
		return $this->rollCallRepository->find($id);
	}

	public function editRollCallById(array $data, int $id)
	{
		return $this->rollCallRepository->updateRollCallById($data, $id);
	}
}