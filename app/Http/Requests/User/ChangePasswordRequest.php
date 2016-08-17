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
			'new_password'     => 'required|min:6',
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
			'*.required'            => '此欄位不能為空',
			'*.min'                 => '此欄位不能小於6個字元',
			'confirm_password.same' => '不能與新密碼欄位值不同'
		];
	}
}