<?php


namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;

class EditUserRequest extends Request
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
			'name'     => 'required|alpha',
			'email'    => 'required|email|unique:users'
		];

		$user = User::find($_REQUEST['id']);
		if ($_REQUEST['email'] === $user->email){
			$rules['name'] = 'required|alpha';
			$rules['email'] = 'required|email';
		}

		return $rules;
	}
}