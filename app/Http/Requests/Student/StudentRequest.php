<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\Request;

class StudentRequest extends Request
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
		return [
			'name'             => 'required',
			'graduated_school' => 'required',
			'student_phone'    => 'required',
			'parent_name'      => 'required',
			'parent_phone'     => 'required',
			'home_address'     => 'required|min:5',
		];
	}

	public function messages()
	{
		return [
			'name.required' => '學生姓名不能為空',
			'graduated_school.required' => '畢業學校不能為空',
			'student_phone.required' => '學生手機不能為空',
			'parent_name.required' => '家長姓名不能為空',
			'parent_phone.required' => '家長手機不能為空',
			'home_address.required' => '家裡地址不能為空',
		];
	}
}
