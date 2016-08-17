<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use JsValidator;

class AuthController extends Controller
{

	protected $loginValidationRules = [
		'email' => 'required|email',
		'password' => 'required|min:6',
	];

	public function getLogin()
	{
		if (Auth::user()) {
			return redirect()->route('backend.home');
		}
		$validator = JsValidator::make($this->loginValidationRules);
		return view('admin.auth.login', compact('validator'));
	}

	public function postLogin(Request $request)
	{
		$auth = Auth::attempt([
			'email'    => $request['email'],
			'password' => $request['password'] ,
			'status'  => 1
		], $request->has('remember'));

		if(!$auth){
			activity('登入狀態')
				->withProperties(['status' => '登入失敗', 'ip' => $request->ip()])
				->log($request['email'].'登入失敗');
			alert()->error('沒有權限登入')->persistent("關閉");
			return redirect()->back();
		}

		activity('登入狀態')
			->withProperties(['status' => '登入成功', 'ip' => $request->ip()])
			->log('一般登入成功');
		alert()->success('登入成功');
		return redirect()->route('backend.home');
	}

}
