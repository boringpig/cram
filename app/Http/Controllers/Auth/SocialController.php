<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialService;
use Socialite;

class SocialController extends Controller
{

	/**
	 * @var SocialService
	 */
	private $social;


	/**
	 * SocialController constructor.
	 *
	 * @param SocialService $social
	 */
	public function __construct(SocialService $social)
	{
		$this->social = $social;
	}

	public function getSocialAuth($provider=null)
	{
		if(!config("services.$provider")) abort('404'); //處理不存在的服務應用程式
		return Socialite::driver($provider)->redirect();
	}

	public function getSocialAuthCallback($provider=null)
	{
		if($user = Socialite::driver($provider)->user()){
			$this->social->loginSocialAuth($provider, $user);
			return redirect()->route('home');
		}else{
			alert()->error('您的應用程式登入帳號有錯誤.', '登入錯誤')->persistent('Close');
			return redirect()->route('login');
		}
	}
}