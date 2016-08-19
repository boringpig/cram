<?php

namespace App\Http\Requests\Lesson;

use App\Http\Requests\Request;
use App\Models\Lesson;

class LessonRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'grade_id'    => 'required',
			'classNo'     => 'required|min:4|unique:lessons',
			'name'        => 'required|min:3|unique:lessons',
			'user_id'     => 'required',
			'description' => 'required',
		];

		if (isset($_REQUEST['id'])) {
			$lesson = Lesson::find($_REQUEST['id']);
			if ($_REQUEST['classNo'] === $lesson->classNo && $_REQUEST['name'] === $lesson->name) {
				$rules['classNo'] = 'required';
				$rules['name']    = 'required';
			}
		}

		return $rules;
	}
}
