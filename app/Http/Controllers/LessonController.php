<?php

namespace App\Http\Controllers;

use App\Services\LessonService;
use Illuminate\Http\Request;

use App\Http\Requests;

class LessonController extends Controller
{

	/**
	 * @var LessonService
	 */
	private $lesson;


	/**
	 * LessonController constructor.
	 *
	 * @param LessonService $lesson
	 */
	public function __construct(LessonService $lesson)
	{
		$this->lesson = $lesson;
	}

	/**
	 * 回傳國小的頁面
	 *
	 * @return mixed
	 */
	public function getElementaryPage()
	{
		$lessons = $this->lesson->showAllElementaryLesson();

		return view('pages.lesson.elementary', compact('lessons'));
    }

	/**
	 * 回傳國中的頁面
	 *
	 * @return mixed
	 */
	public function getJuniorPage()
	{
		$lessons = $this->lesson->showAllJuniorLesson();

		return view('pages.lesson.junior', compact('lessons'));
	}

	/**
	 * 回傳高中職的頁面
	 *
	 * @return mixed
	 */
	public function getSeniorPage()
	{
		$lessons = $this->lesson->showAllSeniorLesson();

		return view('pages.lesson.senior', compact('lessons'));
	}
}
