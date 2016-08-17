<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\Log;
use Auth;

class SocialService
{

	use Log;
	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * SocialService constructor.
	 *
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function loginSocialAuth($provider, $user)
	{
		$user = $this->userRepository->findOrCreateSocialUser($provider, $user);
		Auth::login($user);
		$this->logUserAuth('登入狀態', $provider.'登入成功',[]);
		return $user;
	}
}