<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{

	/**
	 * @var UserService
	 */
	private $user;

	/**
	 * PageController constructor.
	 *
	 * @param UserService $user
	 */
	public function __construct(UserService $user)
	{
		$this->user = $user;
	}

	public function getHomePage()
	{
		$teachers = $this->user->showAllTeachers();

		return view('pages.home', compact('teachers'));
    }

}
