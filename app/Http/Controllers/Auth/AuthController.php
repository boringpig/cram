<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Session;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['getLogout']]);
        $this->user = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //處理不存在的服務應用程式
        return Socialite::driver($provider)->redirect();
    }

    public function getSocialAuthCallback($provider=null)
    {
        if($user = Socialite::driver($provider)->user()){
            //搜尋該使用者是否有此登入方式，回傳該使用者
            $checkUser = $this->user->findOrCreateSocialUser($provider, $user->id, $user);
            //登入此使用者
            Auth::login($checkUser);
            //紀錄使用者登入
            //回傳首頁
            return redirect()->route('home');
        }else{
            Session::flash('error', '您的應用程式登入帳號有錯誤.');
            return redirect()->route('login');
        }
    }
}
