<?php


namespace App\Repositories\User;

use App\Repositories\EloquentDBRepository;
use App\Repositories\User\UserRepository as UserRepositoryContract;
use App\Models\User;
use Hash;

class EloquentUser extends EloquentDBRepository implements UserRepositoryContract
{

	/**
	 * @var User
	 */
	protected $model;

	/**
	 * UserRepository constructor.
	 *
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->model = $user;
		parent::__construct();
	}


	public function findOrCreateSocialUser($type, $id, $userObj)
	{
		$user = $this->model
			->where('account_type', $type)
			->where('sns_acc_id', $id)
			->first();

		if ($user) {
			return $user;
		}

		if ($type == 'facebook') {
			$user = $this->createFacebookUser($userObj);
		}
		if ($type == 'google'){
			$user = $this->createGoogleUser($userObj);
		}

		return $user;
	}

	private function createFacebookUser($userObj)
	{
		$userData = [
			'name' => isset($userObj->name) ? $userObj->name : '',
			'email' => isset($userObj->email) ? $userObj->email : '',
			'avatar_url' => isset($userObj->avatar_original) ? $userObj->avatar_original : '',
			'sns_acc_id' => $userObj->id,
			'account_type' => 'facebook',
		];

		$user = $this->model->create($userData);

		return $user;
	}

	private function createGoogleUser($userObj)
	{
		$userData = [
			'name' => isset($userObj->name) ? $userObj->name : '',
			'email' => isset($userObj->email) ? $userObj->email : '',
			'avatar_url' => isset($userObj->avatar) ? $userObj->avatar : '',
			'sns_acc_id' => $userObj->id,
			'account_type' => 'google',
		];

		$user = $this->model->create($userData);

		return $user;
	}

	public function updateUserProfile(array $data, $id)
	{
		$checkUser = $this->model->find($id);
		if (!$checkUser){
			return null;
		}
		return $this->model
			->where('id', $id)
			->update($data);
	}

	public function updateUserPassword(array $data, $userObj)
	{
		if (Hash::check($data['current_password'], $userObj->password)) {
			$userObj->update([
				'password' => bcrypt($data['new_password'])
			]);
			return true;
		} else {
			return false;
		}
	}
}