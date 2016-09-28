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

	/**
	 * 顯示當天上課的班級
	 *
	 * @return array
	 */
	public function showTodayAllRollCallLesson()
	{
		return $this->lessonRepository->getTodayAllRollCallLesson();
	}

	/**
	 * 顯示選擇的點名班級
	 *
	 * @param array $data
	 * @return array
	 */
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

	/**
	 * AJAX建立或更新點名表狀況
	 *
	 * @param array $data
	 * @return \App\Models\RollCall|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function ajax_RollCallLesson(array $data)
	{
		if ((int)$data['roll_call_id'] != 0){
			return $this->rollCallRepository->updateRollCall($data);
		}

		return $this->rollCallRepository->createRollCall($data);
	}

	/**
	 * 用陣列顯示點名班級
	 *
	 * @return array
	 */
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

	/**
	 * 顯示年/月點名單
	 *
	 * @param array $data
	 * @return array
	 */
	public function showRollCallByDate(array $data)
	{
		return $this->rollCallRepository->getRollCallByDate($data);
	}

	/**
	 * 顯示班級點名單
	 *
	 * @param array $data
	 * @return array
	 */
	public function showRollCallByLesson(array $data)
	{
		return $this->rollCallRepository->getRollCallByLesson($data);
	}

	/**
	 * 顯示特定的點名單
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function showRollCallById(int $id)
	{
		return $this->rollCallRepository->find($id);
	}

	/**
	 * 編輯點名單
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function editRollCallById(array $data, int $id)
	{
		return $this->rollCallRepository->updateRollCallById($data, $id);
	}
}