<?php


namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
			'current_password' => 'required|min:6',
			'new_password' => 'required|min:6',
			'confirm_password' => 'required|min:6|same:new_password',
		];
	}

	/**
	 * Set the custom messages that will be shown for validations
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			//'current_password.currentPassword' => '這不是你目前的密碼',
		];
	}
}