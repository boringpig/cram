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

	public function showAllLessonByArray()
	{
		$lessons = $this->lessonRepository->all();
		$lesson_list = [];

		foreach ($lessons as $lesson){
			$lesson_list[$lesson->id] = $lesson->grade->name . ' ' . $lesson->name;
		}

		return $lesson_list;
	}

	public function showAllLesson()
	{
		return $this->lessonRepository->paginate(8);
	}

	public function addLesson(array $data)
	{
		return $this->lessonRepository->createLesson($data);
	}

	public function showLessonById(int $id)
	{
		return $this->lessonRepository->find($id);
	}

	public function editLesson(array $data, int $id)
	{
		return $this->lessonRepository->updateLesson($data, $id);
	}

	public function deleteLesson(int $id)
	{
		return $this->lessonRepository->deleteLesson($id);
	}
}