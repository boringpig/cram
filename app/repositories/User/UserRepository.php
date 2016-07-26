<?php


namespace App\Repositories\User;


interface UserRepository
{
	public function findOrCreateSocialUser($type, $id, $userObj);
	public function updateUserProfile(array $data, $id);
	public function updateUserPassword(array $data, $userObj);
}