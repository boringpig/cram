<?php


namespace App\Services;


use App\Repositories\LessonRepository;

class LessonService
{

	/**
	 * @var LessonRepository
	 */
	private $lessonRepository;

	/**
	 * LessonService constructor.
	 *
	 * @param LessonRepository $lessonRepository
	 */
	public function __construct(LessonRepository $lessonRepository)
	{
		$this->lessonRepository = $lessonRepository;
	}

	/**
	 * 用陣列顯示全部的班級
	 *
	 * @return array
	 */
	public function showAllLessonByArray()
	{
		$lessons = $this->lessonRepository->all();
		$lesson_list = [];

		foreach ($lessons as $lesson){
			$lesson_list[$lesson->id] = $lesson->grade->name . ' ' . $lesson->name;
		}

		return $lesson_list;
	}

	/**
	 * 顯示全部的班級
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function showAllLesson()
	{
		return $this->lessonRepository->paginate(8);
	}

	/**
	 * 顯示全部的國小班級
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function showAllElementaryLesson()
	{
		return $this->lessonRepository->getAllElementaryLesson();
	}

	/**
	 * 顯示全部的國中班級
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function showAllJuniorLesson()
	{
		return $this->lessonRepository->getAllJuniorLesson();
	}

	/**
	 * 顯示全部的高中職班級
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function showAllSeniorLesson()
	{
		return $this->lessonRepository->getAllSeniorLesson();
	}

	/**
	 * 新增班級
	 *
	 * @param array $data
	 * @return \App\Models\Lesson
	 */
	public function addLesson(array $data)
	{
		return $this->lessonRepository->createLesson($data);
	}

	/**
	 * 顯示特定的班級
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function showLessonById(int $id)
	{
		return $this->lessonRepository->find($id);
	}

	/**
	 * 編輯班級
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function editLesson(array $data, int $id)
	{
		return $this->lessonRepository->updateLesson($data, $id);
	}

	/**
	 * 刪除班級
	 *
	 * @param int $id
	 * @return bool|null
	 */
	public function deleteLesson(int $id)
	{
		return $this->lessonRepository->deleteLesson($id);
	}
}