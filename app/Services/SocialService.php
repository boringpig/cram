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

	/**
	 * 應用程式登入
	 *
	 * @param $provider
	 * @param $user
	 * @return \App\Models\User
	 */
	public function loginSocialAuth($provider, $user)
	{
		$user = $this->userRepository->findOrCreateSocialUser($provider, $user);
		if ($user->status){
			Auth::login($user);
			$this->logUserAuth('登入狀態', $provider.'登入成功', ['ip' => \Request::ip()]);
			return true;
		}
		$this->logUserAuth('登入狀態', $provider.'登入失敗', ['ip' => \Request::ip()]);
		alert()->error('此帳號尚未啟用')->persistent('關閉');
		return false;
	}
}