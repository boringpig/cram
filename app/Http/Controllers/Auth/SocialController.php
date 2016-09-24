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

	/**
	 * 取得應用程式登入
	 *
	 * @param null $provider
	 * @return mixed
	 */
	public function getSocialAuth($provider=null)
	{
		if(!config("services.$provider")) abort('404'); //處理不存在的服務應用程式
		return Socialite::driver($provider)->redirect();
	}

	/**
	 * 應用程式的callback
	 *
	 * @param null $provider
	 * @return mixed
	 */
	public function getSocialAuthCallback($provider=null)
	{
		if($user = Socialite::driver($provider)->user()){
			$result = $this->social->loginSocialAuth($provider, $user);
			if ($result) {
				return redirect()->route('home');
			}
			return redirect()->back();
		}else{
			alert()->error('您的應用程式登入帳號有錯誤.', '登入錯誤')->persistent('Close');
			return redirect()->back();
		}
	}
}